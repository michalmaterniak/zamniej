<?php
namespace App\Application\Pages\Page\Types\Blog\Articles\Seo;

use App\Application\Pages\Page\Seo\PageSeo;
use App\Application\Pages\Resource\Seo\ResourceSeoMethods;
use App\Repository\Repositories\Settings\SettingsRepository;

class BlogArticlesSeo extends PageSeo
{
    /**
     * ShopsSeo constructor.
     * @param ResourceSeoMethods $seoMethods
     * @param SettingsRepository $settingsRepository
     * @param BlogArticlesSeoElements $seoElements
     */
    public function __construct(
        ResourceSeoMethods $seoMethods,
        SettingsRepository $settingsRepository,
        BlogArticlesSeoElements $seoElements
    )
    {
        parent::__construct($seoMethods, $settingsRepository, $seoElements);
    }
}
