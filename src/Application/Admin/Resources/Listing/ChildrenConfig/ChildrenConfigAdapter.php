<?php

namespace App\Application\Admin\Resources\Listing\ChildrenConfig;

use App\Application\Admin\Resources\Listing\ListingResourceInterface;
use App\Application\Pages\Resource\Services\Config\ChildrenConfig;
use App\Services\Pages\Resource\Resource;

class ChildrenConfigAdapter extends ChildrenConfig implements ListingResourceInterface
{
    public function getName(): string
    {
        return 'childrenTypesResource';
    }

    public function getValue()
    {
        return $this->getChildrenConfig();
    }

    /**
     * @param Resource $resource
     */
    public function setResource(Resource $resource): void
    {
        $this->resource = $resource;
    }
}
