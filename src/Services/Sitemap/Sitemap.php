<?php

namespace App\Services\Sitemap;

use App\Repository\Repositories\Subpages\SubpagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\RouterInterface;

class Sitemap
{
    /**
     * @var SubpagesRepository $subpagesRepository
     */
    protected $subpagesRepository;

    /**
     * @var RouterInterface $router
     */
    protected $router;

    public function __construct(SubpagesRepository $subpagesRepository, RouterInterface $router)
    {
        $this->subpagesRepository = $subpagesRepository;
        $this->router = $router;
    }

    public function getUrls()
    {
        $subpages = new ArrayCollection();
        foreach ($this->subpagesRepository->select()->findAllToSitemap()->getResults() as $subpage) {
            $subpages->add([
                'path' => $this->router->generate('page-pages-main', ['slug' => $subpage->getSlug()]),
                'changefreq' => 'daily',
                'priority' => 1,
            ]);
        }
        return $subpages;
    }
}
