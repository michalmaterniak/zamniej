<?php
namespace App\Entity\Entities\Subpages;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SubpageOffers
 * @ORM\Table(name="subpage_offers")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Subpages\SubpageOffersRepository")
 */
class SubpageOffers implements EntityInterface
{
    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $id;

    /**
     * @var Offers $offer
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Shops\Offers\Offers")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id_offer", nullable=false)
     */
    protected $offer;

    /**
     * @var Subpages $subpage
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages")
     * @ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", nullable=false)
     */
    protected $subpage;

    /**
     * @var string $type
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $type;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Offers
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
    }

    /**
     * @return Subpages
     */
    public function getSubpage(): Subpages
    {
        return $this->subpage;
    }

    /**
     * @param Subpages $subpage
     */
    public function setSubpage(Subpages $subpage): void
    {
        $this->subpage = $subpage;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

}
