<?php

namespace App\Entity\Entities\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Affiliations\OffersAffiliation;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


abstract class TradetrackerOffers extends OffersAffiliation
{
    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $id;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $name;

    /**
     * @var DateTime $creationDate
     * @ORM\Column(name="creationDate", type="datetime", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $creationDate;

    /**
     * @var null|DateTime $modificationDate
     * @ORM\Column(name="modification_date", type="datetime", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $modificationDate;

    /**
     * @var bool $referenceSupported
     * @ORM\Column(name="reference_supported", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $referenceSupported = false;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $description = '';

    /**
     * @var ?string $conditions
     * @ORM\Column(name="conditions", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $conditions = '';

    /**
     * @var DateTime $validFromDate
     * @ORM\Column(name="valid_from_date", type="datetime", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $validFromDate;

    /**
     * @var null|DateTime $validToDate
     * @ORM\Column(name="valid_to_date", type="datetime", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $validToDate;

    /**
     * @var float $discountFixed
     * @ORM\Column(name="discount_fixed", type="decimal", precision=10, scale=2, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $discountFixed;

    /**
     * @var float $discountVariable
     * @ORM\Column(name="discount_variable", type="decimal", precision=10, scale=2, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $discountVariable;

    /**
     * @var ?string $voucherCode
     * @ORM\Column(name="voucher_code", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $voucherCode;

    /**
     * @var string $code
     * @ORM\Column(name="code", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $code;

    /**
     * @var int $campaignId
     * @ORM\Column(name="campaign_id", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $campaignId;

    /**
     * @var string $campaignName
     * @ORM\Column(name="campaign_name", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $campaignName;

    /**
     * @var null|string $urlTracking
     * @ORM\Column(name="url_tracking", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $urlTracking;

    /**
     * @var null|string $urlImage
     * @ORM\Column(name="url_image", type="string", length=600, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $urlImage;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        if (is_string($creationDate)) {
            $creationDate = new DateTime($creationDate);
        }
        $this->creationDate = $creationDate;
    }

    /**
     * @return DateTime|null
     */
    public function getModificationDate(): ?DateTime
    {
        return $this->modificationDate;
    }

    /**
     * @param $modificationDate
     */
    public function setModificationDate($modificationDate): void
    {
        if (is_string($modificationDate)) {
            $modificationDate = new DateTime($modificationDate);
        }
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return bool
     */
    public function isReferenceSupported(): bool
    {
        return $this->referenceSupported;
    }

    /**
     * @param bool $referenceSupported
     */
    public function setReferenceSupported(bool $referenceSupported): void
    {
        $this->referenceSupported = $referenceSupported;
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
     * @return string|null
     */
    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    /**
     * @param string|null $conditions
     */
    public function setConditions(?string $conditions): void
    {
        $this->conditions = $conditions;
    }

    /**
     * @return DateTime
     */
    public function getValidFromDate(): DateTime
    {
        return $this->validFromDate;
    }

    /**
     * @param $validFromDate
     */
    public function setValidFromDate($validFromDate = null): void
    {
        if (is_string($validFromDate)) {
            $validFromDate = new DateTime($validFromDate);
        }
        $this->validFromDate = $validFromDate;
    }

    /**
     * @return DateTime
     */
    public function getValidToDate(): DateTime
    {
        return $this->validToDate;
    }

    /**
     * @param $validToDate
     */
    public function setValidToDate($validToDate): void
    {
        if (is_string($validToDate)) {
            $validToDate = new DateTime($validToDate);
        }
        $this->validToDate = $validToDate;
    }

    /**
     * @return float
     */
    public function getDiscountFixed(): float
    {
        return $this->discountFixed;
    }

    /**
     * @param float|null $discountFixed
     */
    public function setDiscountFixed(?float $discountFixed): void
    {
        $this->discountFixed = $discountFixed ?: 0;
    }

    /**
     * @return float
     */
    public function getDiscountVariable(): float
    {
        return $this->discountVariable;
    }

    /**
     * @param float|null $discountVariable
     */
    public function setDiscountVariable(?float $discountVariable): void
    {
        $this->discountVariable = $discountVariable ?: 0;
    }

    /**
     * @return ?string
     */
    public function getVoucherCode(): ?string
    {
        return $this->voucherCode;
    }

    /**
     * @param string|null $voucherCode
     */
    public function setVoucherCode(?string $voucherCode): void
    {
        $this->voucherCode = $voucherCode;
    }

    /**
     * @return string
     */
    public function getCodeText(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCampaignId(): int
    {
        return $this->campaignId;
    }

    /**
     * @param int $campaignId
     */
    public function setCampaignId(int $campaignId): void
    {
        $this->campaignId = $campaignId;
    }

    /**
     * @return string
     */
    public function getCampaignName(): string
    {
        return $this->campaignName;
    }

    /**
     * @param string $campaignName
     */
    public function setCampaignName(string $campaignName): void
    {
        $this->campaignName = $campaignName;
    }

    public function getUrlTracking(): string
    {
        return $this->urlTracking ?: '';
    }

    /**
     * @param string|null $urlTracking
     */
    public function setUrlTracking(?string $urlTracking): void
    {
        $this->urlTracking = $urlTracking;
    }

    public function getUrlImage(): string
    {
        return $this->urlImage ?: '';
    }

    /**
     * @param string|null $urlImage
     */
    public function setUrlImage(?string $urlImage): void
    {
        $this->urlImage = $urlImage;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getDescription();
    }

    /**
     * @return DateTime
     */
    public function getDatetimeFrom(): \DateTime
    {
        return $this->getValidFromDate();
    }

    /**
     * @return DateTime|null
     */
    public function getDatetimeTo(): ?\DateTime
    {
        return $this->getValidToDate();
    }

}
