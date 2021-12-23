<?php
namespace App\Application\Pages\Homepage;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Category\Factory\CategoryFactory;
use App\Application\Pages\ResourceComponents;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Repository\Repositories\Sliders\SlidersRepository;
use App\Repository\Repositories\Subpages\Pages\HomepageRepository;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Repository\Repositories\Subpages\Pages\Types\Blog\BlogArticleRepository;
use App\Repository\Repositories\Subpages\SubpageOffersRepository;
use Symfony\Component\Routing\RouterInterface;

class HomepageComponents extends ResourceComponents
{
    /**
     * @var Slide $slide
     */
    private $slide;

    /**
     * @var OffersRepository $offersRepository
     */
    protected $offersRepository;

    /**
     * @var OffersManager $offersManager
     */
    protected $offersManager;

    /**
     * @var SlidersRepository $sliderRepository
     */
    protected $sliderRepository;

    /**
     * @var ShopRepository $shopRepository
     */
    protected $shopRepository;

    /**
     * @var BlogArticleRepository $blogArticleRepository
     */
    protected $blogArticleRepository;

    /**
     * @var ShopsAffiliationRepository $shopAffiliationRepository
     */
    protected $shopAffiliationRepository;

    public function __construct(
        BlogArticleRepository $blogArticleRepository,
        ShopRepository $shopRepository,
        SlidersRepository $sliderRepository,
        OffersManager $offersManager,
        OffersRepository $offersRepository,
        HomepageRepository $homepageRepository,
        HomepageConfig $resourceConfig,
        CategoryFactory $resourceFactory,
        RouterInterface $router,
        Slide $slide,
        ShopsAffiliationRepository $shopAffiliationRepository,
        protected SubpageOffersRepository $subpageOffersRepository
    )
    {
        parent::__construct($homepageRepository, $resourceConfig, $resourceFactory, $router);
        $this->slide = $slide;
        $this->offersRepository = $offersRepository;
        $this->offersManager = $offersManager;
        $this->sliderRepository = $sliderRepository;
        $this->shopRepository = $shopRepository;
        $this->blogArticleRepository = $blogArticleRepository;
        $this->shopAffiliationRepository = $shopAffiliationRepository;
    }

    /**
     * @return Slide
     */
    public function getSlide(): Slide
    {
        return $this->slide;
    }

    /**
     * @return OffersRepository
     */
    public function getOffersRepository(): OffersRepository
    {
        return $this->offersRepository;
    }

    /**
     * @return OffersManager
     */
    public function getOffersManager(): OffersManager
    {
        return $this->offersManager;
    }

    /**
     * @return SlidersRepository
     */
    public function getSliderRepository(): SlidersRepository
    {
        return $this->sliderRepository;
    }

    /**
     * @return ShopRepository
     */
    public function getShopRepository(): ShopRepository
    {
        return $this->shopRepository;
    }

    /**
     * @return BlogArticleRepository
     */
    public function getBlogArticleRepository(): BlogArticleRepository
    {
        return $this->blogArticleRepository;
    }

    /**
     * @return ShopsAffiliationRepository
     */
    public function getShopAffiliationRepository(): ShopsAffiliationRepository
    {
        return $this->shopAffiliationRepository;
    }

    /**
     * @return SubpageOffersRepository
     */
    public function getSubpageOffersRepository(): SubpageOffersRepository
    {
        return $this->subpageOffersRepository;
    }

}
