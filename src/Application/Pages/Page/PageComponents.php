<?php
namespace App\Application\Pages\Page;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\ResourceComponents;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

abstract class PageComponents extends ResourceComponents
{
    /**
     * @var OffersManager $offersManager
     */
    protected $offersManager;

    /**
     * @var Slide $slide
     */
    protected $slide;

    /**
     * @var Photo $photo
     */
    protected $photo;

    public function __construct(
        PageRepository $pageRepository,
        PageConfig $pageConfig,
        PageFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    ) {
        parent::__construct($pageRepository, $pageConfig, $resourceFactory, $router);
        $this->offersManager = $offersManager;
        $this->slide = $slide;
        $this->photo = $photo;
    }

    /**
     * @return OffersManager
     */
    public function getOffersManager(): OffersManager
    {
        return $this->offersManager;
    }

    /**
     * @return Slide
     */
    public function getSlide(): Slide
    {
        return $this->slide;
    }

    /**
     * @return Photo
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }
}
