<?php
namespace App\Application\Pages\Page;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\Seo\PageSeo;
use App\Services\Pages\Resource\ResourceSubpagesManager;

/**
 * Class HomepageSubpage
 * @package App\Application\Pages\Homepage
 */
abstract class PageSubpagesManager extends ResourceSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        PageSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
