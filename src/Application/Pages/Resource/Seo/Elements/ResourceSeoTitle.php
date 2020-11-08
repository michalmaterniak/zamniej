<?php
namespace App\Application\Pages\Resource\Seo\Elements;

use App\Services\Seo\Elements\SeoTitle;
use App\Services\Seo\Parser\SeoParser;

class ResourceSeoTitle extends SeoTitle
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
