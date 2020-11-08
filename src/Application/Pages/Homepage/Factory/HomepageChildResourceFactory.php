<?php
namespace App\Application\Pages\Homepage\Factory;

use App\Application\Pages\Homepage\Homepage;
use App\Application\Pages\PagesManager;
use App\Application\Pages\Resource\Factory\ResourceChildFactory;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use ErrorException;

class HomepageChildResourceFactory extends ResourceChildFactory
{
    public function __construct(PagesManager $resourcesManager)
    {
        parent::__construct($resourcesManager);
    }

    /**
     * @param string $name
     * @param Homepage $homepage
     * @param string $typeChildClassName
     * @return ResourceFactory
     * @throws ErrorException
     */
    public function createHomepageChild(string $name, Homepage $homepage, string $typeChildClassName) : ResourceFactory
    {
        $childResource = $this->resourceManager->getResourceModelByClassName($typeChildClassName);

        $homepageConfig = $homepage->getComponents()->getResourceConfig();
        $homepageConfig->setChild($childResource->getComponents()->getResourceConfig()->getKey());

        return $this->createResourceChild($name, $homepage, $childResource->getComponents()->getResourceConfig());
    }
}
