<?php
namespace App\Application\Pages\Page\Types\Promotions;

use App\Application\Offers\Offer;
use App\Application\Pages\Page\PageSubpage;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class PromotionsSubpage
 * @package App\Application\Pages\Page\Types\Promotions
 * @method PromotionsComponents getComponents() : ResourceComponents
 */
class PromotionsSubpage extends PageSubpage
{
    /**
     * @var ArrayCollection
     */
    protected $offers;

    public function __construct(PromotionsComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return Offer[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getOffers()
    {
        if (!$this->offers) {
            $this->offers = new ArrayCollection();
            $offers = $this->getComponents()->getOffersManager()->createModelsOffers(
                $this->getComponents()->getOffersRepository()
                    ->select()
                    ->listigPromotions()
                    ->getResults()
            );
            foreach ($offers as $offer) {
                $this->offers->add([
                    'idOffer' => $offer->getOffer()->getIdOffer(),
                    'slug' => $offer->getOffer()->getSubpage()->getSlug(),
                    'title' => $offer->getOffer()->getTitle(),
                    'content' => $offer->getOffer()->getContent()->getContent(),
                    'logo' => $offer->getPhoto()->getModifiedPhoto('insertCenter', 292, 292),
                ]);
            }
        }
        return $this->offers;
    }
}
