<?php
namespace App\Entity\Entities\Affiliations;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Interfaces\UpdateDatetimeInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class OffersAffiliation implements UpdateDatetimeInterface
{
    /**
     * @var int $idOffer
     * @ORM\Column(name="id_offer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $idOffer;

    /**
     * @var ShopsAffiliation $shopAffiliation
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Affiliations\ShopsAffiliation")
     * @ORM\JoinColumn(name="shop_affiliation", referencedColumnName="id_shop", nullable=false)
     * @Groups({"resource", "resource-admin"})
     */
    protected $shopAffiliation;

    /**
     * @var DateTime $datetimeUpdate
     * @ORM\Column(name="datetime_update", type="datetime", nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $datetimeUpdate;

    /**
     * @var Offers|null $offer
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Shops\Offers\Offers")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id_offer", nullable=true, onDelete="CASCADE")
     * @Groups({"resource", "resource-admin"})
     */
    protected $offer;

    public function __construct()
    {
        $this->datetimeUpdate = new DateTime();
    }

    /**
     * @return int
     */
    public function getIdOffer(): int
    {
        return $this->idOffer;
    }

    /**
     * @param int $idOffer
     */
    public function setIdOffer(int $idOffer): void
    {
        $this->idOffer = $idOffer;
    }

    /**
     * @return ShopsAffiliation
     */
    public function getShopAffiliation(): ShopsAffiliation
    {
        return $this->shopAffiliation;
    }

    /**
     * @param ShopsAffiliation $shopAffiliation
     */
    public function setShopAffiliation(ShopsAffiliation $shopAffiliation): void
    {
        $this->shopAffiliation = $shopAffiliation;
    }

    /**
     * @return DateTime
     */
    public function getDatetimeUpdate(): DateTime
    {
        return $this->datetimeUpdate;
    }

    /**
     * @param DateTime $datetimeUpdate
     */
    public function setDatetimeUpdate(DateTime $datetimeUpdate): void
    {
        $this->datetimeUpdate = $datetimeUpdate;
    }

    /**
     * @return Offers|null
     * @Groups({"resource-admin-listing"})
     */
    public function getOffer(): ?Offers
    {
        return $this->offer;
    }

    /**
     * @param Offers|null $offer
     */
    public function setOffer(?Offers $offer): void
    {
        $this->offer = $offer;
    }
}
