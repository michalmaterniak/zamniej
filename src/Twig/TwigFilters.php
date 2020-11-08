<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 15.04.18
 * Time: 16:14
 */
namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;

class TwigFilters extends AbstractExtension
{
    /**
     * @var RequestStack $requestStactk
     */
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
//            new TwigFilter('request', array(
//                $this, 'request',
//                )
//            ),
        );
    }
}
