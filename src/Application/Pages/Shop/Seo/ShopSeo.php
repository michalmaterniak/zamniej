<?php
namespace App\Application\Pages\Shop\Seo;

use App\Services\Seo\Seo;

class ShopSeo extends Seo
{
    public function __construct(ShopSeoElements $seoElements)
    {
        parent::__construct($seoElements);
    }
}
