<?php
namespace App\Application\Pages\Page\Seo;

use App\Application\Pages\Resource\Seo\ResourceSeoMethods;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Seo\Seo;

class PageSeo extends Seo
{
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        PageSeoElements $seoElements
    )
    {
        parent::__construct($seoElements, $settingsRepository, $seoMethods);
    }
}
