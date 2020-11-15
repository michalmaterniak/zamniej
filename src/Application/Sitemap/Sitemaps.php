<?php
namespace App\Application\Sitemap;

use App\Application\Pages\PagesManager;
use App\Services\Sitemap\Sitemaps as GlobalSitemaps;

class Sitemaps extends GlobalSitemaps
{
    public function __construct(PagesManager $resourcesManager)
    {
        parent::__construct($resourcesManager);
    }

    public function getSitemaps()
    {
        return [
            'route'
        ]
    }
}
