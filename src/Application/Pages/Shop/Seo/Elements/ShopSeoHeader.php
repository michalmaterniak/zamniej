<?php
namespace App\Application\Pages\Shop\Seo\Elements;

use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Parser\SeoParser;

class ShopSeoHeader extends SeoHeader
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
