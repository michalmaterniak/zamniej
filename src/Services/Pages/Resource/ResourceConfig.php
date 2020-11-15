<?php
namespace App\Services\Pages\Resource;

use ErrorException;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class ResourceConfig
{
    /**
     * @var int $key
     */
    protected $key = -1; // have to be override

    /**
     * @var string $modelClass
     */
    protected $modelClass = -1; // have to be override

    /**
     * @var int|null $child
     */
    protected $child = null; // have to be override

    /**
     * @var array|int[] $typeChild
     */
    protected $availableTypesChildren = []; // have to be override

    /**
     * @var null|string $entityClass
     */
    protected $entityClass = null; // have to be override

    /**
     * @var string $controller
     */
    protected $controller = ''; // have to be override

    /**
     * @var string $name
     */
    protected $name = ''; // have to be override, be unique

    /**
     * @return string
     * @Groups({"admin"})
     */
    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    /**
     * @return int|null
     * @Groups({"admin"})
     */
    public function getChild(): ?int
    {
        return $this->child;
    }

    /**
     * @return string
     * @Groups({"admin"})
     */
    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    /**
     * @return string
     * @Groups({"admin"})
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     * @Groups({"admin"})
     */
    public function getTypeName(): string
    {
        return str_replace('\\', '-', $this->controller);
    }

    /**
     * @return int
     * @Groups({"admin"})
     */
    public function getKey(): int
    {
        if ($this->key < 0)
            throw new ErrorException('Key ' . $this->key . ' has no model');

        return $this->key;
    }

    /**
     * @return string
     * @Groups({"admin"})
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @param null   $returnDefault
     * @return mixed
     */
    public function getProperty(string $name, $returnDefault = null)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            return $returnDefault;
        }
    }

    /**
     * @return array|int[]
     * @Groups({"admin"})
     */
    public function getAvailableTypesChildren(): array
    {
        return $this->availableTypesChildren;
    }

    /**
     * @param int $type
     * @return bool
     */
    public function isAvailableTypeChild(int $type): bool
    {
        return in_array($type, $this->getAvailableTypesChildren());
    }

    /**
     * @return false|string|string[]
     */
    public function getSlug()
    {
        return mb_strtolower($this->getTypeName());
    }
}
