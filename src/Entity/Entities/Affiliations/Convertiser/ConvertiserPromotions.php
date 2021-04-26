<?php

namespace App\Entity\Entities\Affiliations\Convertiser;

use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Affiliations\OffersAffiliation;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ConvertiserPromotions
 * @ORM\Table(name="convertiser_promotions")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Convertiser\ConvertiserPromotionsRepository")
 */
class ConvertiserPromotions extends OffersAffiliation implements OfferPromotionInterface
{
    /**
     * @param string $field
     * @return string
     */
    public static function __MapFields(string $field): string
    {
        $maps = [
            'offer' => 'offerExternalId'
        ];

        return $maps[$field] ?? $field;
    }

    /**
     * @var string $id
     * @ORM\Column(name="id", type="string", length=50, nullable=false, unique=true, options={"collate"="utf8mb4_bin"})
     */
    protected $id;

    /**
     * @var string $id
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    protected $title;

    /**
     * @var string $shortTitle
     * @ORM\Column(name="short_title", type="string", length=500, nullable=true)
     */
    protected $shortTitle;

    /**
     * @var string $logoThumbnail
     * @ORM\Column(name="logo_thumbnail", type="string", length=700, nullable=false)
     */
    protected $logoThumbnail;

    /**
     * @var string $type
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    protected $type;

    /**
     * @var string $typeName
     * @ORM\Column(name="type_name", type="string", length=50, nullable=false)
     */
    protected $typeName;

    /**
     * @var string $subtype
     * @ORM\Column(name="subtype", type="string", length=50, nullable=false)
     */
    protected $subtype;

    /**
     * @var string $subtypeName
     * @ORM\Column(name="subtype_name", type="string", length=50, nullable=false)
     */
    protected $subtypeName;

    /**
     * @var string $offerExternalId
     * @ORM\Column(name="offer_external_id", type="string", length=50, nullable=false)
     */
    protected $offerExternalId;

    /**
     * @var array $offerDetails
     * @ORM\Column(name="offer_details", type="json", nullable=false)
     */
    protected $offerDetails;

    /**
     * @var string $promoCode
     * @ORM\Column(name="promo_code", type="string", length=200, nullable=false)
     */
    protected $promoCode;

    /**
     * @var bool $exclusive
     * @ORM\Column(name="exclusive", type="boolean", nullable=false)
     */
    protected $exclusive;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    protected $description = "";

    /**
     * @var array $categories
     * @ORM\Column(name="categories", type="json", nullable=false)
     */
    protected $categories;

    /**
     * @var array $categoriesDetails
     * @ORM\Column(name="categories_details", type="json", nullable=false)
     */
    protected $categoriesDetails;

    /**
     * @var DateTime $dateStart
     * @ORM\Column(name="date_start", type="datetime", nullable=false)
     */
    protected $dateStart;

    /**
     * @var DateTime|null $dateEnd
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     */
    protected $dateEnd;

    /**
     * @var DateTime $createdAt
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var bool $isExpired
     * @ORM\Column(name="is_expired", type="boolean", nullable=false)
     */
    protected $isExpired;

    /**
     * @var string $urlTracking
     * @ORM\Column(name="url_tracking", type="string", length=700, nullable=false)
     */
    protected $urlTracking;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortTitle(): string
    {
        return $this->shortTitle;
    }

    /**
     * @param string $shortTitle
     */
    public function setShortTitle(string $shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * @return string
     */
    public function getLogoThumbnail(): string
    {
        return $this->logoThumbnail;
    }

    /**
     * @param string $logoThumbnail
     */
    public function setLogoThumbnail(string $logoThumbnail): void
    {
        $this->logoThumbnail = $logoThumbnail;
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

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     */
    public function setTypeName(string $typeName): void
    {
        $this->typeName = $typeName;
    }

    /**
     * @return string
     */
    public function getSubtype(): string
    {
        return $this->subtype;
    }

    /**
     * @param string $subtype
     */
    public function setSubtype(string $subtype): void
    {
        $this->subtype = $subtype;
    }

    /**
     * @return string
     */
    public function getSubtypeName(): string
    {
        return $this->subtypeName;
    }

    /**
     * @param string $subtypeName
     */
    public function setSubtypeName(string $subtypeName): void
    {
        $this->subtypeName = $subtypeName;
    }

    /**
     * @return string
     */
    public function getOfferExternalId(): string
    {
        return $this->offerExternalId;
    }

    /**
     * @param string $offerExternalId
     */
    public function setOfferExternalId(string $offerExternalId): void
    {
        $this->offerExternalId = $offerExternalId;
    }

    /**
     * @return array
     */
    public function getOfferDetails(): array
    {
        return $this->offerDetails;
    }

    /**
     * @param array $offerDetails
     */
    public function setOfferDetails(array $offerDetails): void
    {
        $this->offerDetails = $offerDetails;
    }

    /**
     * @return string
     */
    public function getPromoCode(): string
    {
        return $this->promoCode;
    }

    /**
     * @param string $promoCode
     */
    public function setPromoCode(string $promoCode): void
    {
        $this->promoCode = $promoCode;
    }

    /**
     * @return bool
     */
    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    /**
     * @param bool $exclusive
     */
    public function setExclusive(bool $exclusive): void
    {
        $this->exclusive = $exclusive;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return array
     */
    public function getCategoriesDetails(): array
    {
        return $this->categoriesDetails;
    }

    /**
     * @param array $categoriesDetails
     */
    public function setCategoriesDetails(array $categoriesDetails): void
    {
        $this->categoriesDetails = $categoriesDetails;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime|string $dateStart
     */
    public function setDateStart($dateStart): void
    {
        if (is_string($dateStart)) {
            $dateStart = new DateTime($dateStart);
        }

        $this->dateStart = $dateStart;
    }

    /**
     * @return DateTime|null
     */
    public function getDateEnd(): ?DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTime|string|null $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        if (is_string($dateEnd)) {
            $dateEnd = new DateTime($dateEnd);
        }
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|string $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        if (is_string($createdAt)) {
            $createdAt = new DateTime($createdAt);
        }
        $this->createdAt = $createdAt;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->isExpired;
    }

    /**
     * @param bool $isExpired
     */
    public function setIsExpired(bool $isExpired): void
    {
        $this->isExpired = $isExpired;
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlTracking(): string
    {
        return $this->urlTracking;
    }

    /**
     * @param string $urlTracking
     */
    public function setUrlTracking(string $urlTracking): void
    {
        $this->urlTracking = $urlTracking;
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getContent(): string
    {
        return $this->getDescription() ?: $this->getShortTitle();
    }

    /**
     * @return DateTime
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeFrom(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * @return DateTime|null
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeTo(): ?DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlImage(): string
    {
        return $this->getLogoThumbnail();
    }
}
