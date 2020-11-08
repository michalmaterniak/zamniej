<?php
namespace App\Repository\Traits;

use App\Entity\Interfaces\EntityInterface;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Parameter;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

trait RepositoryCacheTrait
{
    private $cacheEnable = true;

    /**
     * @var NormalizerInterface $normalizer
     */
    private $normalizer;

    /**
     * @param NormalizerInterface $normalizer
     * @required
     */
    public function setNormalizer(NormalizerInterface $normalizer): void
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @return mixed
     */
    protected function getNormalizer()
    {
        return $this->normalizer;
    }

    protected function getCache($queryBuilder, $callback)
    {
        return $this->getServicesRepositoriesManager()->getCacheManager()->getCache()->getManager()->get($this->createKeyCache($queryBuilder), $callback);
    }

    private function createKeyCache(Query $queryBuilder)
    {
        $dql =          $queryBuilder->getDQL();

        $parameters =   $queryBuilder->getParameters();
        /**
         * @var Parameter $parameter
         */
        foreach ($parameters as $parameter) {
            $value = $parameter->getValue();
            if ($value instanceof EntityInterface) {
                $metaClass = $this->getEntityManager()->getClassMetadata(get_class($value));
                $identifier = $metaClass->getSingleIdentifierFieldName();
                $method = 'get' . ucfirst($identifier);
                $value = $value->$method();
            } else if (is_array($value)) {
                $value = json_encode($value);
            }
            $dql = str_replace(':' . $parameter->getName(), '\'' . $value . '\'', $dql);
        }

        return base64_encode($dql);
    }

    /**
     * @return bool
     */
    protected function cacheEnable() : bool
    {
        return $this->isCacheEnable() && $this->getServicesRepositoriesManager()->getCacheManager()->isEnable();
    }

    abstract public function getServicesRepositoriesManager(): ServicesRepositoriesManager;

    /**
     * @return bool
     */
    protected function isCacheEnable(): bool
    {
        return $this->cacheEnable;
    }

    /**
     * @param bool $cacheEnable
     */
    protected function setCacheEnable(bool $cacheEnable): void
    {
        $this->cacheEnable = $cacheEnable;
    }

    /**
     * @return EntityManager
     */
    abstract protected function getEntityManager();
}
