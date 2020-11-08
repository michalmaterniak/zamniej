<?php
namespace App\Services\Pages\Resource\Factory;

use App\Services\Pages\Resource\Resource;
use App\Services\Pages\Resource\ResourceConfig;
use App\Services\Pages\ResourcesManager;
use ErrorException;

abstract class ResourceChildFactory
{
    /**
     * @var ResourcesManager $resourceManager
     */
    protected $resourceManager;

    public function __construct(
        ResourcesManager $resourcesManager
    ) {
        $this->resourceManager = $resourcesManager;
    }

    /**
     * @param string $name
     * @param Resource $parent
     * @param ResourceConfig|null $resourceChildConfig
     * @return ResourceFactory
     * @throws ErrorException
     */
    public function createResourceChild(string $name, Resource $parent, ResourceConfig $resourceChildConfig = null) : ResourceFactory
    {
        $typeChildClass = $resourceChildConfig
            ? $resourceChildConfig->getModelClass()
            : $this->resourceManager->getResourceModel($parent->getComponents()->getResourceConfig()->getChild())->getComponents()->getResourceConfig()->getModelClass();

        $resourceChild = $this->resourceManager->getResourceModelByClassName($typeChildClass);
        $resourceChild->getComponents()->getResourceFactory()->create($name, $parent->getModelEntity());
        $resourceChild->getComponents()->getResourceFactory()->save();

        return $resourceChild->getComponents()->getResourceFactory();
    }
}
