<?php
namespace App\Application\Pages\Category\Seo\Elements;

use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Parser\SeoParser;

class CategorySeoDescription extends SeoDescription
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
