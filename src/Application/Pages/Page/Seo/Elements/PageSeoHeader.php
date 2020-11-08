<?php
namespace App\Application\Pages\Page\Seo\Elements;

use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Parser\SeoParser;

class PageSeoHeader extends SeoHeader
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
