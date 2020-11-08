<?php
namespace App\Application\Pages\Homepage;

use App\Application\Locale\Locale;
use App\Application\Pages\Homepage\Seo\HomepageSeo;
use App\Services\Pages\Resource\ResourceSubpagesManager;

/**
 * Class HomepageSubpage
 * @package App\Application\Pages\Homepage
 */
class HomepageSubpagesManager extends ResourceSubpagesManager
{
    public function __construct(
        HomepageSeo $seo,
        HomepageSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
