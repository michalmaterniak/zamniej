<?php
namespace App\Application\Pages\Page\Types\Blog\Articles;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Seo\PageSeo;

/**
 * Class BlogArticlesSubpagesManager
 * @package App\Application\Pages\Page\Types\Blog\Articles
 */
class BlogArticlesSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        BlogArticlesSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
