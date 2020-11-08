<?php
namespace App\Application\Pages\Resource\Seo;

use App\Services\Seo\Seo;

class ResourceSeo extends Seo
{
    public function __construct(ResourceSeoElements $seoElements)
    {
        parent::__construct($seoElements);
    }
}
