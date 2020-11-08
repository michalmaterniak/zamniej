<?php
namespace App\Services\Seo\Elements;

use App\Services\Pages\Resource\Resource;
use Symfony\Component\Routing\RouterInterface;

abstract class SeoCanonical
{
    /**
     * @var RouterInterface $router
     */
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getCanonical(Resource $resource)
    {
        return $this->router->generate('page-pages-main', [
            'slug' => $resource->getSubpage()->getSubpage()->getSlug(),
        ], RouterInterface::ABSOLUTE_URL);
    }
}
