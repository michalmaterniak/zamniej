<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 15.04.18
 * Time: 16:14
 */

namespace App\Twig\Subpages;

use Twig\Extension\AbstractExtension;

class LinksFilters extends AbstractExtension
{
    public function __construct()
    {
    }

    public function getFilters()
    {
        return array(
//            new TwigFilter('link', array(
//                $this, 'link',
//                )
//            ),
        );
    }

//    public function link($link, $absolute = false, $defaultEmptyReturn = '#')
//    {
//        return $this->linkManager->getUrl($link, $absolute, $defaultEmptyReturn);
//    }
}
