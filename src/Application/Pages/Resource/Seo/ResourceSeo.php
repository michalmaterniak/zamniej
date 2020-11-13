<?php
namespace App\Application\Pages\Resource\Seo;

use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Seo\Seo;

class ResourceSeo extends Seo
{
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        ResourceSeoElements $seoElements
    )
    {
        parent::__construct($seoElements, $settingsRepository, $seoMethods);
    }
}
