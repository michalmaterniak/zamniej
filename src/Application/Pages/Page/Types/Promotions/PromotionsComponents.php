<?php
namespace App\Application\Pages\Page\Types\Promotions;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\PageComponents;
use App\Application\Pages\Page\Types\Promotions\Factory\PromotionsFactory;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Repository\Repositories\Subpages\Pages\Types\PromotionsRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class PromotionsComponents
 * @package App\Application\Pages\Page\Types\Promotions
 */
class PromotionsComponents extends PageComponents
{
    /**
     * @var OffersRepository $offersRepository
     */
    protected $offersRepository;

    public function __construct(
        OffersRepository $offersRepository,
        PromotionsRepository $promotionsRepository,
        PromotionsConfig $resourceConfig,
        PromotionsFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    )
    {
        parent::__construct($promotionsRepository, $resourceConfig, $resourceFactory, $offersManager, $slide, $photo, $router);
        $this->offersRepository = $offersRepository;
    }

    /**
     * @return OffersRepository
     */
    public function getOffersRepository(): OffersRepository
    {
        return $this->offersRepository;
    }
}
