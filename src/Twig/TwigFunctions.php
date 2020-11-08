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
use Twig\TwigFunction;

class TwigFunctions extends AbstractExtension
{
    /**
     * @var RequestStack $requestStack
     */
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('request', array(
                $this, 'request',
            )),
        );
    }
    public function request(string $name = 'current')
    {
        switch ($name) {
            case 'master':
                return $this->requestStack->getMasterRequest();

            case 'parent':
                return $this->requestStack->getParentRequest();

            case 'current':
            default:
                return $this->requestStack->getCurrentRequest();
        }
    }
}
