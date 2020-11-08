<?php
namespace App\Application\Pages\Shop;

use App\Application\Offers\OffersManager;
use App\Application\Pages\ResourceComponents;
use App\Application\Pages\Shop\Affiliations\ChoiseAffiliation;
use App\Application\Pages\Shop\Factory\ShopFactory;
use App\Application\Pages\Shop\Rating\ShopRating;
use App\Application\Pages\Shop\Tags\TagsShopParser;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Repository\Repositories\Shops\Opinions\ShopOpinionsRepository;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

class ShopComponents extends ResourceComponents
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
     * @var ShopRating $rating
     */
    protected $rating;

    /**
     * @var ChoiseAffiliation $choiseAffiliation
     */
    protected $choiseAffiliation;

    /**
     * @var ShopsAffiliationRepository $shopsAffiliationRepository
     */
    protected $shopsAffiliationRepository;

    /**
     * @var OffersRepository $offersRepository
     */
    protected $offersRepository;

    /**
     * @var ShopOpinionsRepository $shopOpinionsRepository
     */
    protected $shopOpinionsRepository;

    /**
     * @var TagsShopParser $tagsShopParser
     */
    protected $tagsShopParser;

    public function __construct(
        TagsShopParser $tagsShopParser,
        ShopOpinionsRepository $shopOpinionsRepository,
        OffersRepository $offersRepository,
        ShopsAffiliationRepository $shopsAffiliationRepository,
        ChoiseAffiliation $choiseAffiliation,
        ShopRating $rating,
        ShopRepository $shopRepository,
        ShopConfig $resourceConfig,
        ShopFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    )
    {
        parent::__construct($shopRepository, $resourceConfig, $resourceFactory, $router);
        $this->offersManager = $offersManager;
        $this->slide = $slide;
        $this->photo = $photo;
        $this->rating = $rating;
        $this->choiseAffiliation = $choiseAffiliation;
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
        $this->offersRepository = $offersRepository;
        $this->shopOpinionsRepository = $shopOpinionsRepository;
        $this->tagsShopParser = $tagsShopParser;
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
     * @return GlobalRepository
     */
    public function getPageClassRepository()
    {
        return $this->getEntityManager()->getRepository($this->getResourceConfig()->getEntityClass());
    }

    /**
     * @return ShopRating
     */
    public function getRating(): ShopRating
    {
        return $this->rating;
    }

    /**
     * @return ChoiseAffiliation
     */
    public function getChoiseAffiliation(): ChoiseAffiliation
    {
        return $this->choiseAffiliation;
    }

    /**
     * @return ShopsAffiliationRepository
     */
    public function getShopsAffiliationRepository(): ShopsAffiliationRepository
    {
        return $this->shopsAffiliationRepository;
    }

    /**
     * @return OffersRepository
     */
    public function getOffersRepository(): OffersRepository
    {
        return $this->offersRepository;
    }

    /**
     * @return ShopOpinionsRepository
     */
    public function getShopOpinionsRepository(): ShopOpinionsRepository
    {
        return $this->shopOpinionsRepository;
    }

    /**
     * @return TagsShopParser
     */
    public function getTagsShopParser(): TagsShopParser
    {
        return $this->tagsShopParser;
    }
}
