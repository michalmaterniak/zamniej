<?php
namespace App\Services\Pages;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Interfaces\ResourcesInterface;
use App\Repository\Repositories\Subpages\ResourcesRepository;
use App\Services\Pages\Resource\Resource as Resource;
use App\Services\Pages\Resource\ResourceConfig;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ErrorException;

abstract class ResourcesManager
{
    /**
     * @var Resource[]|ArrayCollection
     */
    protected $registredResourceModels;

    /**
     * @var Resource[]|ArrayCollection
     */
    protected $registredResourcesModelsByClassName;

    /**
     * @var ResourcesRepository $resourceRepository
     */
    protected $resourceRepository;

    /**
     * ResourceTypes constructor.
     */
    public function __construct()
    {
        $this->registredResourceModels = new ArrayCollection();
        $this->registredResourcesModelsByClassName = new ArrayCollection();
    }

    /**
     * @param Resource $resourceModel
     */
    public function register(Resource $resourceModel)
    {
        $this->registredResourceModels->set($resourceModel->getComponents()->getResourceConfig()->getKey(), $resourceModel);
        $this->registredResourcesModelsByClassName->set($resourceModel->getComponents()->getResourceConfig()->getModelClass(), $resourceModel);
    }

    /**
     * @param int $key
     * @return Resource
     */
    public function getResourceModel(int $key) : Resource
    {
        if (!$this->registredResourceModels->get($key)) {
            throw new ErrorException('Model is not defined');
        }

        return $this->registredResourceModels->get($key);
    }
    /**
     * @param string $type
     * @return Resource
     */
    public function getResourceModelByClassName(string $type) : Resource
    {
        if (!$this->registredResourcesModelsByClassName->get($type)) {
            throw new ErrorException('Model is not defined');
        }

        return $this->registredResourcesModelsByClassName->get($type);
    }

    /**
     * @param Resources $resourceEntity
     * @return Resource
     */
    public function loadEntity(Resources $resourceEntity): Resource
    {
        $model = clone $this->getResourceModel($resourceEntity->getResourceType());
        $model->loadEntity($resourceEntity);

        return $model;
    }

    /**
     * @param ArrayCollection|Paginator|Resources[] $entities
     */
    public function loadEntities($entities)
    {
        $models = new ArrayCollection();
        foreach ($entities as $entity) {
            $models->add($this->loadEntity($entity));
        }

        return $models;
    }

    /**
     * @param ResourcesInterface $resource
     * @return Resource
     */
    public function loadResource(ResourcesInterface $resource): Resource
    {
        $model = $this->loadEntity($resource->getResource());
        $model->setModelResource($resource);
        return $model;
    }

    /**
     * @param ResourcesInterface[] $resources
     * @return ArrayCollection|Resource[]
     */
    public function loadResources($resources)
    {
        $models = new ArrayCollection();
        foreach ($resources as $resource) {
            $models->add($this->loadResource($resource));
        }

        return $models;
    }

    /**
     * @return Resource[]|ArrayCollection
     */
    public function getResources()
    {
        return $this->registredResourceModels;
    }

    /**
     * @param ResourcesRepository $resourceRepository
     * @required
     */
    public function setResourceRepository(ResourcesRepository $resourceRepository): void
    {
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * @param bool $cache
     * @return Resources|null
     */
    public function getCurrentResourceEntity(bool $cache = true) : ?Resources
    {
        return $this->resourceRepository->select($cache)->getCurrentResource()->getResultOrNull();
    }

    /**
     * @param bool $cache
     * @return Resource|null
     */
    public function getCurrentResourceModel(bool $cache = true) : ?Resource
    {
        $resourceEntity = $this->getCurrentResourceEntity($cache);
        if($resourceEntity)
            return $this->loadEntity($resourceEntity);
        else
            return null;
    }

    /**
     * @return ArrayCollection|ResourceConfig[]
     */
    public function getConfigAllResources() : ArrayCollection
    {
        return $this->registredResourceModels->map(function (Resource $resource) {
            return $resource->getComponents()->getResourceConfig();
        });
    }

}
