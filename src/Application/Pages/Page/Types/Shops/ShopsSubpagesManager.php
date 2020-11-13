<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Types\Shops\Seo\ShopsSeo;

/**
 * Class ShopsSubpagesManager
 * @package App\Application\Pages\Page\Types\Shops
 */
class ShopsSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        ShopsSeo $seo,
        ShopsSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
