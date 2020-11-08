<?php
namespace App\Application\Pages\Homepage;

use App\Application\Offers\Offer;
use App\Application\Offers\OfferPromotion;
use App\Application\Offers\OfferVoucher;
use App\Application\Sliders\Slide;
use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use App\Entity\Entities\Sliders\Sliders;
use App\Repository\Repositories\Sliders\SlidersRepository;
use App\Services\Pages\Resource\Resource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Homepage
 * @package App\Services\Pages\Homepage
 *
 * @method Homepages getResource() : Homepages
 * @method HomepageComponents getComponents() : ResourceComponents
 */
class Homepage extends Resource
{
    public function __construct(
        HomepageSubpagesManager $homepageResourceSubpagesManager,
        HomepageComponents $homepageComponents
    ) {
        parent::__construct($homepageResourceSubpagesManager, $homepageComponents);
    }

}
