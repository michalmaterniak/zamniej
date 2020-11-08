<?php
namespace App\Application\Pages\Shop\Seo\Elements;

use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Parser\SeoParser;

class ShopSeoDescription extends SeoDescription
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
