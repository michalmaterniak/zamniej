<?php
namespace App\Application\Pages\Page\Types\Promotions;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Seo\PageSeo;

/**
 * Class HomepageSubpage
 * @package App\Application\Pages\Homepage
 */
class PromotionsSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        PromotionsSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
