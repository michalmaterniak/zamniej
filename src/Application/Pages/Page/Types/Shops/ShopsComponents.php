<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\PageComponents;
use App\Application\Pages\Page\Types\Shops\Factory\ShopsFactory;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Repository\Repositories\Subpages\Pages\Types\ShopsRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ShopsComponents
 * @package App\Application\Pages\Page\Types\Shops
 */
class ShopsComponents extends PageComponents
{
    /**
     * @var ShopRepository $shopRepository
     */
    protected $shopRepository;

    public function __construct(
        ShopRepository $shopRepository,
        ShopsRepository $shopsRepository,
        ShopsConfig $resourceConfig,
        ShopsFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    )
    {
        parent::__construct($shopsRepository, $resourceConfig, $resourceFactory, $offersManager, $slide, $photo, $router);
        $this->shopRepository = $shopRepository;
    }

    /**
     * @return ShopRepository
     */
    public function getShopRepository(): ShopRepository
    {
        return $this->shopRepository;
    }
}
