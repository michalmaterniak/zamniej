<?php
namespace App\Application\Pages\Category\Seo;

use App\Application\Pages\Resource\Seo\ResourceSeoMethods;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Seo\Seo;

class CategorySeo extends Seo
{
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        CategorySeoElements $seoElements
    )
    {
        parent::__construct($seoElements, $settingsRepository, $seoMethods);
    }
}
