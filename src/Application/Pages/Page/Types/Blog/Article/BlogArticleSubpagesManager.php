<?php
namespace App\Application\Pages\Page\Types\Blog\Article;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Seo\PageSeo;

/**
 * Class BlogArticleSubpagesManager
 * @package App\Application\Pages\Page\Types\Blog\Article
 */
class BlogArticleSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        BlogArticleSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
