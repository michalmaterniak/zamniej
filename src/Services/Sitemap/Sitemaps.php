<?php

namespace App\Services\Sitemap;

use App\Services\Pages\Resource\ResourceConfig;
use App\Services\Pages\ResourcesManager;
use Doctrine\Common\Collections\ArrayCollection;

class Sitemaps
{
    /**
     * @var ResourcesManager $resourcesManager
     */
    protected $resourcesManager;

    /**
     * @var ResourceConfig[]|ArrayCollection
     */
    protected $resourcesConfig;

    public function __construct(ResourcesManager $resourcesManager)
    {
        $this->resourcesManager = $resourcesManager;
        $this->resourcesConfig = new ArrayCollection();
    }

    public function getSitemaps()
    {
        if (!$this->resourcesConfig) {
            foreach ($this->resourcesManager->getResources() as $resource) {
                $this->resourcesConfig->add($resource);
            }
        }

        return $this->resourcesConfig;
    }
}
