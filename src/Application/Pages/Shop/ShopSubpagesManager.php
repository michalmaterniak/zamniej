<?php
namespace App\Application\Pages\Shop;

use App\Application\Locale\Locale;
use App\Application\Pages\Shop\Seo\ShopSeo;
use App\Services\Pages\Resource\ResourceSubpagesManager;

class ShopSubpagesManager extends ResourceSubpagesManager
{
    public function __construct(
        ShopSeo $seo,
        ShopSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
