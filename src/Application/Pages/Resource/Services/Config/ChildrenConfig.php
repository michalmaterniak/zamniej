<?php

namespace App\Application\Pages\Resource\Services\Config;

use App\Application\Pages\PagesManager;
use App\Services\Pages\Resource\Services\Config\ChildrenConfig as GlobalChildrenConfig;

class ChildrenConfig extends GlobalChildrenConfig
{
    public function __construct(PagesManager $resourcesManager)
    {
        parent::__construct($resourcesManager);
    }
}
