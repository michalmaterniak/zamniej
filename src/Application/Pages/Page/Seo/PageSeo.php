<?php
namespace App\Application\Pages\Page\Seo;

use App\Services\Seo\Seo;

class PageSeo extends Seo
{
    public function __construct(PageSeoElements $seoElements)
    {
        parent::__construct($seoElements);
    }
}
