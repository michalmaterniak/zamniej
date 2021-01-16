<?php
namespace App\Services\System\EntityServices\Updater;

use App\Entity\Interfaces\EntityInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;
use function Symfony\Component\String\u;

class EntityUpdater
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var EntityInterface $entity
     */
    protected $entity;

    /**
     * @var array $associations
     */
    protected $associations;

    /**
     * @var array $properties
     */
    protected $properties;

    /**
     * EntityUpdater constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param EntityInterface $entity
     */
    public function setEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
        $this->associations = $this->entityManager->getClassMetadata(get_class($entity))->getAssociationNames();
    }

    /**
     * @param string $method
     * @return bool
     */
    protected function isRelation(string $method)
    {
        return in_array('get' . ucfirst($method), $this->associations);
    }

    /**
     * @param string $methodName
     * @return string|null
     */
    protected function getGetterMethod(string $methodName)
    {
        $method = 'get' . ucfirst($methodName);
        if (method_exists($this->entity, $method)) {
            return $method;
        }

        $method = 'is' . ucfirst($methodName);
        if (method_exists($this->entity, $method)) {
            return $method;
        }
        return null;
    }

    /**
     * @param string $methodName
     * @return string|null
     */
    protected function getSetterMethod(string $methodName)
    {
        $method = 'set' . ucfirst(u($methodName)->camel());
        return method_exists($this->entity, $method) ? $method : null;
    }

    /**
     * @param EntityInterface $entity
     * @return $this
     */
    protected function newUpdater(EntityInterface $entity) : self
    {
        $updater = clone $this;
        $updater->setEntity($entity);
        return $updater;
    }

    /**
     * @param $value
     * @param $method
     */
    protected function setValue($value, $method)
    {
        $this->entity->$method($value);
    }

    /**
     * @param EntityInterface $entity
     * @param array $property
     */
    protected function updateEntity(EntityInterface $entity, array $property)
    {
        $updater = $this->newUpdater($entity);
        $updater->update($property);
    }

    /**
     * @param PersistentCollection $entities
     * @param array $property
     */
    protected function updateEntitiesCollection(PersistentCollection $entities, array $property)
    {
        foreach ($entities as $key => $value)
            $this->updateEntity($value, $property[$key]);
    }

    /**
     * @param $value
     * @param $method
     */
    protected function updateValue($value, $method)
    {
        $this->entity->$method($value);
    }

    /**
     * @param array $property
     * @param string $nameMethod
     */
    protected function updateData(array $property, string $nameMethod = 'data')
    {
        $method = $this->getSetterMethod($nameMethod);

        foreach ($property as $key => $item)
        {
            $this->entity->$method($item, $key);
        }
    }

    /**
     * @param array $properties
     */
    public function update(array $properties)
    {
        $this->properties = $properties;
        foreach ($this->properties as $key => $property) {
            if ($property instanceof EntityInterface) {
                $setter = $this->getSetterMethod($key);
                if ($setter)
                    $this->updateValue($property, $setter);
                continue;
            }
            if ($getter = $this->getGetterMethod($key)) {

                $value = $this->entity->$getter();
                if ($value instanceof EntityInterface) { // dla encji
                    $this->updateEntity($value, $property);
                    continue;
                } elseif ($value instanceof PersistentCollection) { // dla kolekcji encji

                    $this->updateEntitiesCollection($value, $property);
                    continue;
                } elseif (is_array($value) && ($key === 'extra' || $key === 'data')) { // extra to alias data
                    $this->updateData($property);
                    continue;
                } elseif ($value instanceof DateTime) {
                    $setter = $this->getSetterMethod($key);
                    if ($setter)
                        $this->updateValue(new DateTime($property), $setter);
                    continue;
                } elseif (is_array($value)) { // dla innych json'ow, np. settings
                    $this->updateData($property, $key);
                    continue;
                } else {// pozostałe - skalarne. zwykłe settery
                    $setter = $this->getSetterMethod($key);
                    if ($setter)
                        $this->updateValue($property, $setter);
                }
            }
        }
    }

    public function persist($entity)
    {
        $this->entityManager->persist($entity);
    }

    public function flush()
    {
        $this->entityManager->flush();
    }
}
