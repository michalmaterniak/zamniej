<?php
namespace App\Application\Pages\Category\Seo;

use App\Services\Seo\Seo;

class CategorySeo extends Seo
{
    public function __construct(CategorySeoElements $seoElements)
    {
        parent::__construct($seoElements);
    }
}
