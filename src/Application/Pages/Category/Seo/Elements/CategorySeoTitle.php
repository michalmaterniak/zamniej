<?php
namespace App\Application\Pages\Category\Seo\Elements;

use App\Services\Seo\Elements\SeoTitle;
use App\Services\Seo\Parser\SeoParser;

class CategorySeoTitle extends SeoTitle
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
