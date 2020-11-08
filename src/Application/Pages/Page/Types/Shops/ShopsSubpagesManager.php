<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Seo\PageSeo;

/**
 * Class ShopsSubpagesManager
 * @package App\Application\Pages\Page\Types\Shops
 */
class ShopsSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        ShopsSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
