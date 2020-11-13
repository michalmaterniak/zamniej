<?php
namespace App\Application\Pages\Shop\Seo;

use App\Application\Pages\Resource\Seo\ResourceSeoMethods;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\Seo\Seo;

/**
 * Class ShopSeo
 * @package App\Application\Pages\Shop\Seo
 */
class ShopSeo extends Seo
{
    /**
     * ShopSeo constructor.
     * @param ResourceSeoMethods $seoMethods
     * @param SettingsRepository $settingsRepository
     * @param ShopSeoElements $seoElements
     */
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        ShopSeoElements $seoElements
    )
    {
        parent::__construct($seoElements, $settingsRepository, $seoMethods);
    }
}
