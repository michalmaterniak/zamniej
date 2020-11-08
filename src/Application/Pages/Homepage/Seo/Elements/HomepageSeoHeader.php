<?php
namespace App\Application\Pages\Homepage\Seo\Elements;

use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Parser\SeoParser;

class HomepageSeoHeader extends SeoHeader
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
