<?php
namespace App\Application\Pages\Category;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Category\Factory\CategoryFactory;
use App\Application\Pages\ResourceComponents;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

class CategoryComponents extends ResourceComponents
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

    /**
     * @var ShopRepository $shopRepository
     */
    protected $shopRepository;

    public function __construct(
        ShopRepository $shopRepository,
        CategoryRepository $categoryRepository,
        CategoryConfig $resourceConfig,
        CategoryFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    ) {
        parent::__construct($categoryRepository, $resourceConfig, $resourceFactory, $router);
        $this->shopRepository = $shopRepository;
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

    /**
     * @return ShopRepository
     */
    public function getShopRepository(): ShopRepository
    {
        return $this->shopRepository;
    }
}
