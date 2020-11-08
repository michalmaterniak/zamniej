<?php
namespace App\Application\Pages\Shop\Seo\Elements;

use App\Services\Seo\Elements\SeoTitle;
use App\Services\Seo\Parser\SeoParser;

class ShopSeoTitle extends SeoTitle
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
