<?php
namespace App\Application\Pages\Homepage\Seo;

use App\Services\Seo\Seo;

class HomepageSeo extends Seo
{
    public function __construct(HomepageSeoElements $seoElements)
    {
        parent::__construct($seoElements);
    }
}
