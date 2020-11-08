<?php
namespace App\Application\Offers;

use App\Application\Pages\PagesManager;
use App\Application\Sliders\Slide;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

class OfferComponents
{
    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

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

    /**
     * @var RouterInterface $router
     */
    protected $router;

    public function __construct(
        Photo               $photo,
        Slide               $slide,
        OffersManager       $offersManager,
        RouterInterface     $router
    ) {
        $this->photo =          $photo;
        $this->slide =          $slide;
        $this->offersManager =  $offersManager;
        $this->router =         $router;
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

    /**
     * @return PagesManager
     */
    public function getPagesManager(): PagesManager
    {
        return $this->pagesManager;
    }

    /**
     * @param PagesManager $pagesManager
     * @required
     */
    public function setPagesManager(PagesManager $pagesManager): void
    {
        $this->pagesManager = $pagesManager;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }
}
