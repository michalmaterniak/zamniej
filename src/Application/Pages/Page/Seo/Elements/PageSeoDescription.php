<?php
namespace App\Application\Pages\Page\Seo\Elements;

use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Parser\SeoParser;

class PageSeoDescription extends SeoDescription
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
