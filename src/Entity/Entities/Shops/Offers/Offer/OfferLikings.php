<?php
namespace App\Entity\Entities\Shops\Offers\Offer;

use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * OfferLikings
 * @ORM\Table(name="offer_likings")
 * @ORM\Entity
 */
class OfferLikings implements EntityInterface
{
    /**
     * @var int $idOfferLiking
     * @ORM\Column(name="id_offer_liking", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $idOfferLiking;

    /**
     * @var int $countNegative
     * @ORM\Column(name="count_negative", type="integer", nullable=false)
     * @Groups({"resource", "resource-admin","resource-admin"})
     */
    protected $countNegative = 0;

    /**
     * @var int $countPositive
     * @ORM\Column(name="count_positive", type="integer", nullable=false)
     * @Groups({"resource", "resource-admin","resource-admin"})
     */
    protected $countPositive = 0;

    /**
     * @return int
     */
    public function getIdOfferLiking(): int
    {
        return $this->idOfferLiking;
    }

    /**
     * @param int $idOfferLiking
     */
    public function setIdOfferLiking(int $idOfferLiking): void
    {
        $this->idOfferLiking = $idOfferLiking;
    }

    /**
     * @return int
     */
    public function getCountNegative(): int
    {
        return $this->countNegative;
    }

    /**
     * @param int $countNegative
     */
    public function setCountNegative(int $countNegative): void
    {
        $this->countNegative = $countNegative;
    }

    /**
     * @return int
     */
    public function getCountPositive(): int
    {
        return $this->countPositive;
    }

    /**
     * @param int $countPositive
     */
    public function setCountPositive(int $countPositive): void
    {
        $this->countPositive = $countPositive;
    }

    /**
     * @param int $count
     */
    public function addPositive($count = 1) : void
    {
        $this->countPositive = $this->countPositive + $count;
    }

    /**
     * @param int $count
     */
    public function addNegative($count = 1) : void
    {
        $this->countNegative = $this->countNegative + $count;
    }
}
