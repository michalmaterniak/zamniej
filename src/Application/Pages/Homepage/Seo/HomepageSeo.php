<?php
namespace App\Application\Pages\Homepage\Seo;

use App\Application\Pages\Resource\Seo\ResourceSeoMethods;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Seo\Seo;

class HomepageSeo extends Seo
{
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        HomepageSeoElements $seoElements
    )
    {
        parent::__construct($seoElements, $settingsRepository, $seoMethods);
    }
}
