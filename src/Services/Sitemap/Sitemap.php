<?php
namespace App\Services\Sitemap;

use App\Repository\Repositories\Subpages\ResourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\RouterInterface;

class Sitemap
{
    /**
     * @var ResourcesRepository $resourcesRepository
     */
    protected $resourcesRepository;

    /**
     * @var RouterInterface $router
     */
    protected $router;

    public function __construct(ResourcesRepository $resourcesRepository, RouterInterface $router)
    {
        $this->resourcesRepository = $resourcesRepository;
        $this->router = $router;
    }

    public function getUrls()
    {
        $subpages = new ArrayCollection();
        foreach ($this->resourcesRepository->select()->findAllToSitemap()->getResults() as $resource) {
            foreach ($resource->getSubpages() as $subpage) {
                $subpages->add([
                    'path' => $this->router->generate('page-pages-main', ['slug' => $subpage->getSlug()]),
                    'changefreq' => 'daily',
                    'priority' => 1,
                ]);
            }
        }
        return $subpages;
    }
}
