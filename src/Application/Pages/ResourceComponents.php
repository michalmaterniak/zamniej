<?php
namespace App\Application\Pages;

use App\Services\Pages\Resource\ResourceComponents as GlobalResourceComponents;

abstract class ResourceComponents extends GlobalResourceComponents
{
    /**
     * @var PagesManager $resourceManager
     */
    protected $pagesManager;

    /**
     * @param PagesManager $pagesManager
     * @required
     */
    public function setPagesManager(PagesManager $pagesManager): void
    {
        $this->pagesManager = $pagesManager;
    }

    /**
     * @return PagesManager
     */
    public function getResourcesManager(): PagesManager
    {
        return $this->pagesManager;
    }
}
