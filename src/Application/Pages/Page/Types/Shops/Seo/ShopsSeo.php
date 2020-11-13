<?php

namespace App\Application\Pages\Page\Types\Shops\Seo;

use App\Application\Pages\Page\Seo\PageSeo;
use App\Repository\Repositories\Settings\SettingsRepository;

class ShopsSeo extends PageSeo
{
    /**
     * ShopsSeo constructor.
     * @param ShopsSeoMethods $seoMethods
     * @param SettingsRepository $settingsRepository
     * @param ShopsSeoElements $seoElements
     */
    public function __construct(
        ShopsSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        ShopsSeoElements $seoElements
    )
    {
        parent::__construct($seoMethods, $settingsRepository, $seoElements);
    }
}
