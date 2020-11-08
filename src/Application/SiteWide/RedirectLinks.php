<?php
namespace App\Application\SiteWide;

use Symfony\Component\Routing\RouterInterface;

class RedirectLinks implements FrontInitInterface
{
    /**
     * @var
     */
    protected $router;
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getName(): string
    {
        return 'linksRedirect';
    }

    public function getValue()
    {
        return [
            'offer' => $this->router->generate('page-pages-redirect-offer', [],RouterInterface::ABSOLUTE_URL),
            'shop' => $this->router->generate('page-pages-redirect-shop',[], RouterInterface::ABSOLUTE_URL)
        ];
    }
}
