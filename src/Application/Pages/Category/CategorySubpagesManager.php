<?php
namespace App\Application\Pages\Category;

use App\Application\Locale\Locale;
use App\Application\Pages\Category\Seo\CategorySeo;
use App\Services\Pages\Resource\ResourceSubpagesManager;

class CategorySubpagesManager extends ResourceSubpagesManager
{
    public function __construct(CategorySeo $seo, CategorySubpage $subpageResource, Locale $locale)
    {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
