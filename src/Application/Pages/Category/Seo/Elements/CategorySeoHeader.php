<?php
namespace App\Application\Pages\Category\Seo\Elements;

use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Parser\SeoParser;

class CategorySeoHeader extends SeoHeader
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
