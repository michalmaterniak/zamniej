<?php
namespace App\Application\Pages\Homepage\Seo\Elements;

use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Parser\SeoParser;

class HomepageSeoDescription extends SeoDescription
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
