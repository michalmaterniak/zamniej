<?php
namespace App\Entity\Entities\Shops\Offers;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Shops\Offers\Offer\OfferLikings;
use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\Contents;
use App\Entity\Entities\System\Files;
use App\Entity\Interfaces\EntityInterface;
use App\Entity\Interfaces\UpdateDatetimeInterface;
use App\Entity\Traits\DataTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Offers
 * @ORM\Table(name="offers")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     0 = "App\Entity\Entities\Shops\Offers\Offers",
 *     1 = "App\Entity\Entities\Shops\Offers\OffersPromotion",
 *     2 = "App\Entity\Entities\Shops\Offers\OffersVoucher",
 *     3 = "App\Entity\Entities\Shops\Offers\OffersBanner",
 *     4 = "App\Entity\Entities\Shops\Offers\OffersProduct",
 * })
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Offers\OffersRepository")
 */
class Offers implements EntityInterface, UpdateDatetimeInterface
{
    protected static $datetime = null;

    /**
     * @var int $idOffer
     * @ORM\Column(name="id_offer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $idOffer;

    /**
     * @var DateTime $datetimeFrom
     * @ORM\Column(name="datetime_from", type="datetime", nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $datetimeFrom;

    /**
     * @var DateTime|null $datetimeTo
     * @ORM\Column(name="datetime_to", type="datetime", nullable=true)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $datetimeTo = null;

    /**
     * @var string|null $url
     * @ORM\Column(name="url", type="string", length=700, nullable=true)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $url;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", length=400, nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-listing"})
     */
    protected $title = '';

    /**
     * @var Contents $content
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\System\Contents", cascade={"persist", "remove"}, fetch="LAZY", orphanRemoval=true)
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id_content")
     * @Groups({"resource", "resource-admin","offers-admin-listing"})
     */
    protected $content;

    /**
     * @var ShopsAffiliation $shopAffiliation
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Affiliations\ShopsAffiliation")
     * @ORM\JoinColumn(name="shop_affiliation", referencedColumnName="id_shop", nullable=false)
     * @Groups({"resource-admin"})
     */
    protected $shopAffiliation;

    /**
     * @var Files|null $photo
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\System\Files", cascade={"persist"})
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id_file", nullable=true)
     * @Groups({"resource-admin", "resource-admin-listing-shops"})
     */
    protected $photo = null;

    /**
     * @var DateTime $datetimeUpdate
     * @ORM\Column(name="datetime_update", type="datetime", nullable=false)
     * @Groups({"resource-admin", "resorce-admin-listing"})
     */
    protected $datetimeUpdate;

    /**
     * @var DateTime $datetimeCreate
     * @ORM\Column(name="datetime_create", type="datetime", nullable=false)
     */
    protected $datetimeCreate;

    /**
     * @var int $redirectCount
     * @ORM\Column(name="redirect_count", type="integer", length=11, nullable=false)
     * @Groups({"resource", "resource-admin","offers-admin-listing"})
     */
    protected $redirectCount = 0;

    /**
     * @var Subpages $subpage
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages", fetch="LAZY")
     * @ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", nullable=false, onDelete="CASCADE")
     */
    protected $subpage;

    /**
     * @var OfferLikings $liking
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\Shops\Offers\Offer\OfferLikings", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(name="offer_liking_id", referencedColumnName="id_offer_liking", nullable=false, onDelete="CASCADE")
     * @Groups({"resource", "resource-admin","resource-admin"})
     */
    protected $liking;

    /**
     * @var bool $active
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = true;

    use DataTrait;

    public function __construct()
    {
        $this->content = new Contents();
        $this->datetimeUpdate = new DateTime();
        $this->datetimeCreate = new DateTime();
        $this->liking = new OfferLiking();
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
     * @return DateTime
     */
    public function getDatetimeFrom(): DateTime
    {
        return $this->datetimeFrom;
    }

    /**
     * @param DateTime|string $datetimeFrom
     */
    public function setDatetimeFrom($datetimeFrom): void
    {
        if (is_string($datetimeFrom)) {
            $this->datetimeFrom = new DateTime($datetimeFrom);
        } elseif ($datetimeFrom instanceof DateTime) {
            $this->datetimeFrom = $datetimeFrom;
        }
    }

    /**
     * @return DateTime|null
     */
    public function getDatetimeTo(): ?DateTime
    {
        return $this->datetimeTo;
    }

    /**
     * @param DateTime|string|null $datetimeTo
     */
    public function setDatetimeTo($datetimeTo): void
    {
        if (is_string($datetimeTo)) {
            $this->datetimeTo = new DateTime($datetimeTo);
        } elseif ($datetimeTo instanceof DateTime) {
            $this->datetimeTo = $datetimeTo;
        } elseif (is_null($datetimeTo)) {
            $this->datetimeTo = null;
        }
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title ?: '';
    }

    /**
     * @return Contents
     */
    public function getContent(): Contents
    {
        return $this->content;
    }

    /**
     * @param Contents|string $content
     */
    public function setContent($content): void
    {
        if (is_string($content)) {
            $this->content->setContent($content);
        } elseif ($content instanceof Contents) {
            $this->content = $content;
        }
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
     * @return Files|null
     */
    public function getPhoto(): ?Files
    {
        return $this->photo;
    }

    /**
     * @param Files|null $photo
     */
    public function setPhoto(?Files $photo): void
    {
        $this->photo = $photo;
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
     * @return DateTime
     */
    public function getDatetimeCreate(): DateTime
    {
        return $this->datetimeCreate;
    }

    /**
     * @return int
     */
    public function getRedirectCount(): int
    {
        return $this->redirectCount;
    }

    /**
     * @param int $count
     */
    public function addRedirect($count = 1): void
    {
        $this->redirectCount += $count;
        $this->shopAffiliation->addRedirect();
    }

    /**
     * @param int $redirectCount
     */
    public function setRedirectCount(int $redirectCount): void
    {
        $this->redirectCount = $redirectCount;
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
     * @return OfferLikings
     */
    public function getLiking(): OfferLikings
    {
        return $this->liking;
    }

    /**
     * @param OfferLikings $liking
     */
    public function setLiking(OfferLikings $liking): void
    {
        $this->liking = $liking;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool
     * @Groups({"resource", "resource-admin"})
     */
    public function isActual()
    {
        if (!static::$datetime) {
            static::$datetime = new DateTime();
        }

        return $this->isActive() && (!$this->getDatetimeTo() || $this->getDatetimeTo() > static::$datetime);
    }
}
