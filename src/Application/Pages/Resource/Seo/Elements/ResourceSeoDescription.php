<?php
namespace App\Application\Pages\Resource\Seo\Elements;

use App\Services\Seo\Elements\SeoDescription;
use App\Services\Seo\Parser\SeoParser;

class ResourceSeoDescription extends SeoDescription
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
