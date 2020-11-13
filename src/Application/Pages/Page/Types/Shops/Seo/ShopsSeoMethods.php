<?php

namespace App\Application\Pages\Page\Types\Shops\Seo;

use App\Application\Pages\Page\Types\Shops\Seo\Methods\LetterSeoMethod;
use App\Application\Pages\Resource\Seo\ResourceSeoMethods;

/**
 * Class ShopsSeoMethods
 * @package App\Application\Pages\Page\Types\Shops\Seo
 */
class ShopsSeoMethods extends ResourceSeoMethods
{
    function __construct(LetterSeoMethod $pageSeoMethod)
    {
        parent::__construct();
        $this->register($pageSeoMethod);
    }
}
