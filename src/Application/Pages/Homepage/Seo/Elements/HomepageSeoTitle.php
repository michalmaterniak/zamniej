<?php
namespace App\Application\Pages\Homepage\Seo\Elements;

use App\Services\Seo\Elements\SeoTitle;
use App\Services\Seo\Parser\SeoParser;

class HomepageSeoTitle extends SeoTitle
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
