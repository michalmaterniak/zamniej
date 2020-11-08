<?php
namespace App\Application\Pages\Resource\Seo\Elements;

use App\Services\Seo\Elements\SeoHeader;
use App\Services\Seo\Parser\SeoParser;

class ResourceSeoHeader extends SeoHeader
{
    public function __construct(SeoParser $seoParser)
    {
        parent::__construct($seoParser);
    }
}
