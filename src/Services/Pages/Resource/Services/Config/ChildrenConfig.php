<?php

namespace App\Services\Pages\Resource\Services\Config;

use App\Entity\Entities\Subpages\Resources;
use App\Services\Pages\Resource\Resource;
use App\Services\Pages\Resource\ResourceConfig;
use App\Services\Pages\ResourcesManager;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ChildrenConfig
 * @package App\Services\Pages\Resource\Services\Config
 */
abstract class ChildrenConfig
{
    /**
     * @var ResourcesManager $resourcesManager
     */
    protected $resourcesManager;

    /**
     * @var Resource $resource
     */
    protected $resource;

    public function __construct(ResourcesManager $resourcesManager)
    {
        $this->resourcesManager = $resourcesManager;
    }

    /**
     * @param Resources $entity
     * @return ArrayCollection|ResourceConfig[]
     */
    public function getTypesByEntity(Resources $entity)
    {
        return $this->getTypesByResource($this->resourcesManager->loadEntity($entity));
    }

    public function getTypesByResource(Resource $resource)
    {
        $this->resource = $resource;
        return $this->getChildrenConfig();
    }

    /**
     * @return ArrayCollection|ResourceConfig[]
     */
    protected function getChildrenConfig()
    {
        $availableChildrenConfig = new ArrayCollection();
        foreach ($this->resource->getComponents()->getResourceConfig()->getAvailableTypesChildren() as $childType) {
            $availableChildrenConfig->add($this->resourcesManager->getResourceModel($childType)->getComponents()->getResourceConfig());
        }
        return $availableChildrenConfig;
    }
}
