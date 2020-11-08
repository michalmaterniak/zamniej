<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 15.04.18
 * Time: 16:14
 */

namespace App\Twig\Subpages;

use App\Services\Pages\Managers\SubpagesEntityManager;
use Twig\Extension\AbstractExtension;

class LinksFunction extends AbstractExtension
{
    public function __construct()
    {
    }

    public function getFunctions()
    {
        return array(
//            new TwigFunction('links', array(
//                $this, 'links',
//                )
//            ),
        );
    }
}
