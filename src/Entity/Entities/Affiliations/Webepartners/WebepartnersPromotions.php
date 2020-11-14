<?php
namespace App\Entity\Entities\Affiliations\Webepartners;
use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Affiliations\OffersAffiliation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class WebepartnersPromotions
 * @ORM\Table(name="webepartners_promotions")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Webepartners\WebepartnersPromotionsRepository")
 */
class WebepartnersPromotions extends OffersAffiliation implements OfferPromotionInterface
{

    /**
     * @var string $voucherId
     * @ORM\Column(name="voucher_id", type="string", length=50, nullable=false, unique=true)
     */
    protected $voucherId;

    /**
     * @var string|null $voucherName
     * @ORM\Column(name="voucher_name", type="string", length=200, nullable=true)
     */
    protected $voucherName;

    /**
     * @var string|null $voucherText
     * @ORM\Column(name="voucher_text", type="text", nullable=true)
     */
    protected $voucherText;

    /**
     * @var \DateTime $dateFrom
     * @ORM\Column(name="date_from", type="datetime", nullable=false)
     */
    protected $dateFrom;

    /**
     * @var \DateTime $dateTo
     * @ORM\Column(name="date_to", type="datetime", nullable=false)
     */
    protected $dateTo;

    /**
     * @var int $programId
     * @ORM\Column(name="program_id", type="integer", nullable=false)
     */
    protected $programId;

    /**
     * @var string $affiliateProgramId
     * @ORM\Column(name="affiliate_program_id", type="string", length=50, nullable=false)
     */
    protected $affiliateProgramId;

    /**
     * @var string|null $programName
     * @ORM\Column(name="program_name", type="string", length=200, nullable=true)
     */
    protected $programName;

    /**
     * @var string|null $voucherUrl
     * @ORM\Column(name="voucher_url", type="string", length=400, nullable=true)
     */
    protected $voucherUrl;

    /**
     * @var string|null $voucherTrackingUrl
     * @ORM\Column(name="voucher_tracking_url", type="string", length=700, nullable=true)
     */
    protected $voucherTrackingUrl;

    /**
     * @var int $voucherTypeId
     * @ORM\Column(name="voucher_type_id", type="integer", nullable=false)
     */
    protected $voucherTypeId;

    /**
     * @var string|null $voucherTypeName
     * @ORM\Column(name="voucher_type_name", type="string", length=20, nullable=true)
     */
    protected $voucherTypeName;

    /**
     * @return string
     */
    public function getVoucherId(): string
    {
        return $this->voucherId;
    }

    /**
     * @param string $voucherId
     */
    public function setVoucherId(string $voucherId): void
    {
        $this->voucherId = $voucherId;
    }

    /**
     * @return string|null
     */
    public function getVoucherName(): ?string
    {
        return $this->voucherName;
    }

    /**
     * @param string|null $voucherName
     */
    public function setVoucherName(?string $voucherName): void
    {
        $this->voucherName = $voucherName;
    }

    /**
     * @return string|null
     */
    public function getVoucherText(): ?string
    {
        return $this->voucherText;
    }

    /**
     * @param string|null $voucherText
     */
    public function setVoucherText(?string $voucherText): void
    {
        $this->voucherText = $voucherText;
    }

    /**
     * @return \DateTime
     */
    public function getDateFrom(): \DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTime|string $dateFrom
     */
    public function setDateFrom($dateFrom): void
    {
        if(is_string($dateFrom))
            $this->dateFrom = new \DateTime($dateFrom);
        else if($dateFrom instanceof \DateTime)
            $this->dateFrom = $dateFrom;
    }

    /**
     * @return \DateTime
     */
    public function getDateTo(): \DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTime $dateTo
     */
    public function setDateTo($dateTo): void
    {
        if(is_string($dateTo))
            $this->dateTo = new \DateTime($dateTo);
        else if($dateTo instanceof \DateTime)
            $this->dateTo = $dateTo;
        else if(is_null($dateTo))
            $this->dateTo = null;
    }

    /**
     * @return int
     */
    public function getProgramId(): int
    {
        return $this->programId;
    }

    /**
     * @param int $programId
     */
    public function setProgramId(int $programId): void
    {
        $this->programId = $programId;
    }

    /**
     * @return string
     */
    public function getAffiliateProgramId(): string
    {
        return $this->affiliateProgramId;
    }

    /**
     * @param string $affiliateProgramId
     */
    public function setAffiliateProgramId(string $affiliateProgramId): void
    {
        $this->affiliateProgramId = $affiliateProgramId;
    }

    /**
     * @return string|null
     */
    public function getProgramName(): ?string
    {
        return $this->programName;
    }

    /**
     * @param string|null $programName
     */
    public function setProgramName(?string $programName): void
    {
        $this->programName = $programName;
    }

    /**
     * @return string|null
     */
    public function getVoucherUrl(): ?string
    {
        return $this->voucherUrl;
    }

    /**
     * @param string|null $voucherUrl
     */
    public function setVoucherUrl(?string $voucherUrl): void
    {
        $this->voucherUrl = $voucherUrl;
    }

    /**
     * @return string|null
     */
    public function getVoucherTrackingUrl(): ?string
    {
        return $this->voucherTrackingUrl;
    }

    /**
     * @param string|null $voucherTrackingUrl
     */
    public function setVoucherTrackingUrl(?string $voucherTrackingUrl): void
    {
        $this->voucherTrackingUrl = $voucherTrackingUrl;
    }

    /**
     * @return int
     */
    public function getVoucherTypeId(): int
    {
        return $this->voucherTypeId;
    }

    /**
     * @param int $voucherTypeId
     */
    public function setVoucherTypeId(int $voucherTypeId): void
    {
        $this->voucherTypeId = $voucherTypeId;
    }

    /**
     * @return string|null
     */
    public function getVoucherTypeName(): ?string
    {
        return $this->voucherTypeName;
    }

    /**
     * @param string|null $voucherTypeName
     */
    public function setVoucherTypeName(?string $voucherTypeName): void
    {
        $this->voucherTypeName = $voucherTypeName;
    }




    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getTitle(): string
    {
        return $this->getVoucherName();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getContent(): string
    {
        return $this->getVoucherText();
    }

    /**
     * @return \DateTime
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeFrom(): \DateTime
    {
        return $this->getDateFrom();
    }

    /**
     * @return \DateTime|null
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeTo(): ?\DateTime
    {
        return $this->getDateTo();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlTracking(): string
    {
        return $this->getVoucherTrackingUrl();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlImage(): string
    {
        return $this->getShopAffiliation()->getUrlLogo();
    }
}
