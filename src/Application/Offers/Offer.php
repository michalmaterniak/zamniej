<?php
namespace App\Application\Offers;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Services\Photos\Photo;
use Symfony\Component\Serializer\Annotation\Groups;

class Offer extends OfferAbstract
{
    /**
     * @var Photo $photo
     */
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     * @Groups({"resource"})
     */

    /**
     * @var Offers $offer
     */
    protected $offer;

    public function getTypeOffer(): string
    {
        return 'offer';
    }

    /**
     * @return Offers
     * @Groups({"resource"})
     */
    public function getOffer(): Offers
    {
        return $this->offer;
    }

    /**
     * @param Offers $offer
     */
    public function setOffer(Offers $offer): void
    {
        $this->offer = $offer;
        if ($offer->getPhoto()) {
            $this->photo = $this->getComponents()->getPhoto()->createModelPhoto($offer->getPhoto());
        }
    }

    /**
     * @return Photo
     * @Groups({"resource"})
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    /**
     * @return int
     * @Groups({"resource"})
     */
    public function getIdShop()
    {
        return $this->getOffer()->getShopAffiliation()->getIdShop();
    }
}
