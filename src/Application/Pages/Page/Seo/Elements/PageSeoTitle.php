<?php
namespace App\Application\Pages\Page\Seo\Elements;

use App\Services\Seo\Elements\SeoTitle;
use App\Services\Seo\Parser\SeoParser;

class PageSeoTitle extends SeoTitle
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
