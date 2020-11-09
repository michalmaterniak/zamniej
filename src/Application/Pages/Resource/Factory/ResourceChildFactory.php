<?php
namespace App\Application\Pages\Resource\Factory;

use App\Application\Pages\PagesManager;
use App\Services\Pages\Resource\Factory\ResourceChildFactory as GlobalResourceChildFactory;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Pages\Resource\Resource as Resource;
use App\Services\Pages\Resource\ResourceConfig;

class ResourceChildFactory extends GlobalResourceChildFactory
{
    public function __construct(PagesManager $resourcesManager)
    {
        parent::__construct($resourcesManager);
    }

    public function createResourceChild(string $name, Resource $parent, ResourceConfig $resourceChildConfig = null): ResourceFactory
    {
        return parent::createResourceChild($name, $parent, $resourceChildConfig);
    }

    public function creatByParentAndKeye()
    {

    }
}
