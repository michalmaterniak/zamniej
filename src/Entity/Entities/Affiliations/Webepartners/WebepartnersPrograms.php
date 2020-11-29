<?php
namespace App\Entity\Entities\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class WebepartnersPrograms
 * @ORM\Table(name="webepartners_programs")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository")
 */
class WebepartnersPrograms extends ShopsAffiliation
{
    /**
     * @var int $programId
     * @ORM\Column(name="program_id", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $programId;

    /**
     * @var string $affiliateProgramId
     * @ORM\Column(name="affiliate_program_id", type="string", length=100, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $affiliateProgramId;

    /**
     * @var DateTime $createDate
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $createDate;

    /**
     * @var DateTime|null $updateDate
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $updateDate;

    /**
     * @var string $programName
     * @ORM\Column(name="program_name", type="string", length=100, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $programName;

    /**
     * @var string|null $programLogoUrl
     * @ORM\Column(name="program_logo_url", type="string", length=700, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $programLogoUrl;

    /**
     * @var string|null $programUrl
     * @ORM\Column(name="program_url", type="string", length=700, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $programUrl;

    /**
     * @var string|null $affiliateTrackingProgramUrl
     * @ORM\Column(name="affiliate_tracking_program_url", type="string", length=700, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $affiliateTrackingProgramUrl;

    /**
     * @var bool $isBanner
     * @ORM\Column(name="is_banner", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isBanner;

    /**
     * @var bool $isDeeplink
     * @ORM\Column(name="is_deeplink", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isDeeplink;

    /**
     * @var bool $isWidget
     * @ORM\Column(name="is_widget", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isWidget;

    /**
     * @var bool $isXml
     * @ORM\Column(name="is_xml", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isXml;

    /**
     * @var bool $isVouchers
     * @ORM\Column(name="is_vouchers", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isVouchers;

    /**
     * @var bool $isMailing
     * @ORM\Column(name="is_mailing", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isMailing;

    /**
     * @var float $cpcCommission
     * @ORM\Column(name="cpc_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $cpcCommission;

    /**
     * @var float $cpsCommission
     * @ORM\Column(name="cps_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $cpsCommission;

    /**
     * @var float $leadCommission
     * @ORM\Column(name="lead_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $leadCommission;

    /**
     * @var int $cookiesTime
     * @ORM\Column(name="cookies_time", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $cookiesTime;

    /**
     * @var int $relationId
     * @ORM\Column(name="relation_id", type="smallint", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $relationId;

    /**
     * @var string|null $feedUrl
     * @ORM\Column(name="feed_url", type="string", length=700, nullable=true)
     * @Groups({"program-admin"})
     */
    protected $feedUrl;

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
        $this->setExternalId($this->getProgramId());
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
     * @return DateTime
     */
    public function getCreateDate(): DateTime
    {
        return $this->createDate;
    }

    /**
     * @param DateTime|string $createDate
     */
    public function setCreateDate($createDate): void
    {
        if (is_string($createDate)) {
            $this->createDate = new DateTime($createDate);
        } elseif ($createDate instanceof DateTime) {
            $this->createDate = $createDate;
        }
    }

    /**
     * @return DateTime|null
     */
    public function getUpdateDate(): ?DateTime
    {
        return $this->updateDate;
    }

    /**
     * @param DateTime|string|null $updateDate
     */
    public function setUpdateDate($updateDate): void
    {
        if (is_string($updateDate)) {
            $this->updateDate = new DateTime($updateDate);
        } elseif ($updateDate instanceof DateTime) {
            $this->updateDate = $updateDate;
        }
    }

    /**
     * @return string
     */
    public function getProgramName(): string
    {
        return $this->programName;
    }

    /**
     * @param string $programName
     */
    public function setProgramName(string $programName): void
    {
        $this->programName = $programName;
        $this->setName($programName);
    }

    /**
     * @return string|null
     */
    public function getProgramLogoUrl(): ?string
    {
        return $this->programLogoUrl;
    }

    /**
     * @param string|null $programLogoUrl
     */
    public function setProgramLogoUrl(?string $programLogoUrl): void
    {
        $this->programLogoUrl = $programLogoUrl;
        $this->setUrlLogo($this->programLogoUrl);
    }

    /**
     * @return string|null
     */
    public function getProgramUrl(): ?string
    {
        return $this->programUrl;
    }

    /**
     * @param string|null $programUrl
     */
    public function setProgramUrl(?string $programUrl): void
    {
        $this->programUrl = $programUrl;
    }

    /**
     * @return string|null
     */
    public function getAffiliateTrackingProgramUrl(): ?string
    {
        return $this->affiliateTrackingProgramUrl;
    }

    /**
     * @param string|null $affiliateTrackingProgramUrl
     */
    public function setAffiliateTrackingProgramUrl(?string $affiliateTrackingProgramUrl): void
    {
        $this->affiliateTrackingProgramUrl = $affiliateTrackingProgramUrl;
    }

    /**
     * @return bool
     */
    public function isBanner(): bool
    {
        return $this->isBanner;
    }

    /**
     * @param bool $isBanner
     */
    public function setIsBanner(bool $isBanner): void
    {
        $this->isBanner = $isBanner;
    }

    /**
     * @return bool
     */
    public function isDeeplink(): bool
    {
        return $this->isDeeplink;
    }

    /**
     * @param bool $isDeeplink
     */
    public function setIsDeeplink(bool $isDeeplink): void
    {
        $this->isDeeplink = $isDeeplink;
    }

    /**
     * @return bool
     */
    public function isWidget(): bool
    {
        return $this->isWidget;
    }

    /**
     * @param bool $isWidget
     */
    public function setIsWidget(bool $isWidget): void
    {
        $this->isWidget = $isWidget;
    }

    /**
     * @return bool
     */
    public function isXml(): bool
    {
        return $this->isXml;
    }

    /**
     * @param bool $isXml
     */
    public function setIsXml(bool $isXml): void
    {
        $this->isXml = $isXml;
    }

    /**
     * @return bool
     */
    public function isVouchers(): bool
    {
        return $this->isVouchers;
    }

    /**
     * @param bool $isVouchers
     */
    public function setIsVouchers(bool $isVouchers): void
    {
        $this->isVouchers = $isVouchers;
    }

    /**
     * @return bool
     */
    public function isMailing(): bool
    {
        return $this->isMailing;
    }

    /**
     * @param bool $isMailing
     */
    public function setIsMailing(bool $isMailing): void
    {
        $this->isMailing = $isMailing;
    }

    /**
     * @return float
     */
    public function getCpcCommission(): float
    {
        return $this->cpcCommission;
    }

    /**
     * @param float $cpcCommission
     */
    public function setCpcCommission(float $cpcCommission): void
    {
        $this->cpcCommission = $cpcCommission;
    }

    /**
     * @return float
     */
    public function getCpsCommission(): float
    {
        return $this->cpsCommission;
    }

    /**
     * @param float $cpsCommission
     */
    public function setCpsCommission(float $cpsCommission): void
    {
        $this->cpsCommission = $cpsCommission;
    }

    /**
     * @return float
     */
    public function getLeadCommission(): float
    {
        return $this->leadCommission;
    }

    /**
     * @param float $leadCommission
     */
    public function setLeadCommission(float $leadCommission): void
    {
        $this->leadCommission = $leadCommission;
    }

    /**
     * @return int
     */
    public function getCookiesTime(): int
    {
        return $this->cookiesTime;
    }

    /**
     * @param int $cookiesTime
     */
    public function setCookiesTime(int $cookiesTime): void
    {
        $this->cookiesTime = $cookiesTime;
    }

    /**
     * @return int
     */
    public function getRelationId(): int
    {
        return $this->relationId;
    }

    /**
     * @param int $relationId
     */
    public function setRelationId(int $relationId): void
    {
        $this->relationId = $relationId;
        if ($this->relationId == 4) {
            $this->setEnable(true);
        } else {
            $this->setEnable(false);
        }
    }

    /**
     * @return string|null
     */
    public function getFeedUrl(): ?string
    {
        return $this->feedUrl;
    }

    /**
     * @param string|null $feedUrl
     */
    public function setFeedUrl(?string $feedUrl): void
    {
        $this->feedUrl = $feedUrl;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getCps(): float
    {
        return $this->getCpsCommission();
    }

    /**
     * @return float
     */
    public function getCpc(): float
    {
        return 0.0;
    }

    /**
     * @return string
     */
    public function getTrackingUrl(): string
    {
        return $this->getLinkForce() ?: $this->getAffiliateTrackingProgramUrl();
    }
}
