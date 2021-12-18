<?php

namespace App\Entity\Entities\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class TradetrackerPrograms
 * @ORM\Table(name="tradetracker_programs")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerProgramsRepository")
 */
class TradetrackerPrograms extends ShopsAffiliation
{
    protected static $assignmentStatusEnum = ['notsignedup', 'pending', 'accepted', 'rejected', 'onhold', 'signedout'];

    protected static $policyStatusEnum = ['limited', 'disallowed', 'allowed'];

    protected static $attributionsEnum = ['classic', 'firstTouchpoint', 'lastTouchpoint', 'linear', 'timeDecay', 'positionBased', 'custom'];

    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $id;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $name;

    /**
     * @var array $name
     * @ORM\Column(name="category", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $category;

    /**
     * @var array $subCategories
     * @ORM\Column(name="sub_categories", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $subCategories = [];

    /**
     * @var string $campaignDescription
     * @ORM\Column(name="campaign_description", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $campaignDescription;

    /**
     * @var string $shopDescription
     * @ORM\Column(name="shop_description", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $shopDescription;

    /**
     * @var null|string $targetGroup
     * @ORM\Column(name="target_group", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $targetGroup;

    /**
     * @var null|string $characteristics
     * @ORM\Column(name="characteristics", type="text", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $characteristics;

    /**
     * @var string $imageURL
     * @ORM\Column(name="image_url", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $imageURL;

    /**
     * @var string $trackingURL
     * @ORM\Column(name="tracking_url", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $trackingURL;

    /**
     * @var float $impressionCommission
     * @ORM\Column(name="impression_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $impressionCommission;

    /**
     * @var float $clickCommission
     * @ORM\Column(name="click_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $clickCommission;

    /**
     * @var float $fixedCommission
     * @ORM\Column(name="fixed_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $fixedCommission;

    /**
     * @var float $leadCommission
     * @ORM\Column(name="lead_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $leadCommission;

    /**
     * @var float $saleCommissionFixed
     * @ORM\Column(name="sale_commission_fixed", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $saleCommissionFixed;

    /**
     * @var float $saleCommissionVariable
     * @ORM\Column(name="sale_commission_variable", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $saleCommissionVariable;

    /**
     * @var float $iLeadCommission
     * @ORM\Column(name="ilead_commission", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $iLeadCommission;

    /**
     * @var float $iSaleCommissionFixed
     * @ORM\Column(name="isale_commission_fixed", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $iSaleCommissionFixed;

    /**
     * @var float $iSaleCommissionVariable
     * @ORM\Column(name="isale_commission_variable", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $iSaleCommissionVariable;

    /**
     * @var string $assignmentStatus
     * @ORM\Column(name="assignment_status", type="string", nullable=false)
     */
    protected $assignmentStatus;

    /**
     * @var null|\DateTime $startDate
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $startDate;

    /**
     * @var null|\DateTime $stopDate
     * @ORM\Column(name="stop_date", type="datetime", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $stopDate = null;

    /**
     * @var string $timeZone
     * @ORM\Column(name="time_zone", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $timeZone = 'Europe/Warsaw';

    /**
     * @var string $clickToConversion
     * @ORM\Column(name="click_to_conversion", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $clickToConversion;

    /**
     * @var string $policySearchEngineMarketingStatus
     * @ORM\Column(name="policy_search_engine_marketing_status", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policySearchEngineMarketingStatus;

    /**
     * @var string $policyEmailMarketingStatus
     * @ORM\Column(name="policy_email_marketing_status", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyEmailMarketingStatus;

    /**
     * @var string $policyCashbackStatus
     * @ORM\Column(name="policy_cashback_status", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyCashbackStatus;

    /**
     * @var string $policyDiscountCodeStatus
     * @ORM\Column(name="policy_discount_code_status", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyDiscountCodeStatus;

    /**
     * @var bool $deeplinkingSupported
     * @ORM\Column(name="deeplinking_supported", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $deeplinkingSupported = false;

    /**
     * @var bool $referencesSupported
     * @ORM\Column(name="references_supported", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $referencesSupported;

    /**
     * @var ?string $leadMaximumAssessmentInterval
     * @ORM\Column(name="lead_maximum_assessment_interval", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $leadMaximumAssessmentInterval;

    /**
     * @var ?string $leadAverageAssessmentInterval
     * @ORM\Column(name="lead_average_assessment_interval", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $leadAverageAssessmentInterval;

    /**
     * @var ?string $saleMaximumAssessmentInterval
     * @ORM\Column(name="sale_maximum_assessment_interval", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $saleMaximumAssessmentInterval;

    /**
     * @var ?string $saleAverageAssessmentInterval
     * @ORM\Column(name="sale_average_assessment_interval", type="string", nullable=true)
     * @Groups({"program-admin"})
     */
    protected $saleAverageAssessmentInterval;

    /**
     * @var string $attributionModelLead
     * @ORM\Column(name="attribution_model_lead", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $attributionModelLead;

    /**
     * @var string $attributionModelSales
     * @ORM\Column(name="attribution_model_sales", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $attributionModelSales;

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
        $this->setExternalId($id);
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
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @param array $category
     */
    public function setCategory(array $category): void
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function getSubCategories(): array
    {
        return $this->subCategories;
    }

    /**
     * @param array $subCategories
     */
    public function setSubCategories(array $subCategories): void
    {
        $this->subCategories = $subCategories;
    }

    /**
     * @return string
     */
    public function getCampaignDescription(): string
    {
        return $this->campaignDescription;
    }

    /**
     * @param string $campaignDescription
     */
    public function setCampaignDescription(string $campaignDescription): void
    {
        $this->campaignDescription = $campaignDescription;
    }

    /**
     * @return string
     */
    public function getShopDescription(): string
    {
        return $this->shopDescription;
    }

    /**
     * @param $shopDescription
     */
    public function setShopDescription($shopDescription): void
    {
        $this->shopDescription = $shopDescription ?: '';
    }

    /**
     * @return string|null
     */
    public function getTargetGroup(): ?string
    {
        return $this->targetGroup;
    }

    /**
     * @param string|null $targetGroup
     */
    public function setTargetGroup(?string $targetGroup): void
    {
        $this->targetGroup = $targetGroup;
    }

    /**
     * @return string|null
     */
    public function getCharacteristics(): ?string
    {
        return $this->characteristics;
    }

    /**
     * @param string|null $characteristics
     */
    public function setCharacteristics(?string $characteristics): void
    {
        $this->characteristics = $characteristics;
    }

    /**
     * @return string
     */
    public function getImageURL(): string
    {
        return $this->imageURL;
    }

    /**
     * @param string $imageURL
     */
    public function setImageURL(string $imageURL): void
    {
        $this->imageURL = $imageURL;
        $this->setUrlLogo($imageURL);
    }

    /**
     * @return string
     */
    public function getTrackingURL(): string
    {
        return $this->trackingURL;
    }

    /**
     * @param string $trackingURL
     */
    public function setTrackingURL(string $trackingURL): void
    {
        $this->trackingURL = $trackingURL;
    }

    /**
     * @return float
     */
    public function getImpressionCommission(): float
    {
        return $this->impressionCommission;
    }

    /**
     * @param float $impressionCommission
     */
    public function setImpressionCommission(float $impressionCommission): void
    {
        $this->impressionCommission = $impressionCommission;
    }

    /**
     * @return float
     */
    public function getClickCommission(): float
    {
        return $this->clickCommission;
    }

    /**
     * @param float $clickCommission
     */
    public function setClickCommission(float $clickCommission): void
    {
        $this->clickCommission = $clickCommission;
    }

    /**
     * @return float
     */
    public function getFixedCommission(): float
    {
        return $this->fixedCommission;
    }

    /**
     * @param float $fixedCommission
     */
    public function setFixedCommission(float $fixedCommission): void
    {
        $this->fixedCommission = $fixedCommission;
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
     * @return float
     */
    public function getSaleCommissionFixed(): float
    {
        return $this->saleCommissionFixed;
    }

    /**
     * @param float $saleCommissionFixed
     */
    public function setSaleCommissionFixed(float $saleCommissionFixed): void
    {
        $this->saleCommissionFixed = $saleCommissionFixed;
    }

    /**
     * @return float
     */
    public function getSaleCommissionVariable(): float
    {
        return $this->saleCommissionVariable;
    }

    /**
     * @param float $saleCommissionVariable
     */
    public function setSaleCommissionVariable(float $saleCommissionVariable): void
    {
        $this->saleCommissionVariable = $saleCommissionVariable;
    }

    /**
     * @return float
     */
    public function getILeadCommission(): float
    {
        return $this->iLeadCommission;
    }

    /**
     * @param float $iLeadCommission
     */
    public function setILeadCommission(float $iLeadCommission): void
    {
        $this->iLeadCommission = $iLeadCommission;
    }

    /**
     * @return float
     */
    public function getISaleCommissionFixed(): float
    {
        return $this->iSaleCommissionFixed;
    }

    /**
     * @param float $iSaleCommissionFixed
     */
    public function setISaleCommissionFixed(float $iSaleCommissionFixed): void
    {
        $this->iSaleCommissionFixed = $iSaleCommissionFixed;
    }

    /**
     * @return float
     */
    public function getISaleCommissionVariable(): float
    {
        return $this->iSaleCommissionVariable;
    }

    /**
     * @param float $iSaleCommissionVariable
     */
    public function setISaleCommissionVariable(float $iSaleCommissionVariable): void
    {
        $this->iSaleCommissionVariable = $iSaleCommissionVariable;
    }

    /**
     * @return string
     */
    public function getAssignmentStatus(): string
    {
        return $this->assignmentStatus;
    }

    /**
     * @param string $assignmentStatus
     */
    public function setAssignmentStatus(string $assignmentStatus): void
    {
        if (!in_array($assignmentStatus, static::$assignmentStatusEnum)) {
            throw new \ErrorException($assignmentStatus . ' Nieznany typ');
        }
        $this->assignmentStatus = $assignmentStatus;
        if ($assignmentStatus === 'accepted') {
            $this->setEnable(true);
        } else {
            $this->setEnable(false);
        }
    }

    /**
     * @return \DateTime|null
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * @param $startDate
     */
    public function setStartDate($startDate): void
    {
        if(is_string($startDate)) {
            $startDate = new \DateTime($startDate);
        }
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getStopDate(): ?\DateTime
    {
        return $this->stopDate;
    }

    /**
     * @param $stopDate
     */
    public function setStopDate($stopDate): void
    {
        if(is_string($stopDate)) {
            $stopDate = new \DateTime($stopDate);
        }
        $this->stopDate = $stopDate;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     */
    public function setTimeZone(string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    /**
     * @return string
     */
    public function getClickToConversion(): string
    {
        return $this->clickToConversion;
    }

    /**
     * @param string $clickToConversion
     */
    public function setClickToConversion(string $clickToConversion): void
    {
        $this->clickToConversion = $clickToConversion;
    }

    /**
     * @return string
     */
    public function getPolicySearchEngineMarketingStatus(): string
    {
        return $this->policySearchEngineMarketingStatus;
    }

    /**
     * @param string $policySearchEngineMarketingStatus
     */
    public function setPolicySearchEngineMarketingStatus(string $policySearchEngineMarketingStatus): void
    {
        if (!in_array($policySearchEngineMarketingStatus, static::$policyStatusEnum)) {
            throw new \ErrorException($policySearchEngineMarketingStatus . ' Nieznany typ');
        }
        $this->policySearchEngineMarketingStatus = $policySearchEngineMarketingStatus;
    }

    /**
     * @return string
     */
    public function getPolicyEmailMarketingStatus(): string
    {
        return $this->policyEmailMarketingStatus;
    }

    /**
     * @param string $policyEmailMarketingStatus
     */
    public function setPolicyEmailMarketingStatus(string $policyEmailMarketingStatus): void
    {
        if (!in_array($policyEmailMarketingStatus, static::$policyStatusEnum)) {
            throw new \ErrorException($policyEmailMarketingStatus . ' Nieznany typ');
        }
        $this->policyEmailMarketingStatus = $policyEmailMarketingStatus;
    }

    /**
     * @return string
     */
    public function getPolicyCashbackStatus(): string
    {
        return $this->policyCashbackStatus;
    }

    /**
     * @param string $policyCashbackStatus
     */
    public function setPolicyCashbackStatus(string $policyCashbackStatus): void
    {
        if (!in_array($policyCashbackStatus, static::$policyStatusEnum)) {
            throw new \ErrorException($policyCashbackStatus . ' Nieznany typ');
        }
        $this->policyCashbackStatus = $policyCashbackStatus;
    }

    /**
     * @return string
     */
    public function getPolicyDiscountCodeStatus(): string
    {
        return $this->policyDiscountCodeStatus;
    }

    /**
     * @param string $policyDiscountCodeStatus
     */
    public function setPolicyDiscountCodeStatus(string $policyDiscountCodeStatus): void
    {
        if (!in_array($policyDiscountCodeStatus, static::$policyStatusEnum)) {
            throw new \ErrorException($policyDiscountCodeStatus . ' Nieznany typ');
        }
        $this->policyDiscountCodeStatus = $policyDiscountCodeStatus;
    }

    /**
     * @return bool
     */
    public function isDeeplinkingSupported(): bool
    {
        return $this->deeplinkingSupported;
    }

    /**
     * @param bool $deeplinkingSupported
     */
    public function setDeeplinkingSupported(bool $deeplinkingSupported): void
    {
        $this->deeplinkingSupported = $deeplinkingSupported;
    }

    /**
     * @return bool
     */
    public function isReferencesSupported(): bool
    {
        return $this->referencesSupported;
    }

    /**
     * @param bool $referencesSupported
     */
    public function setReferencesSupported(bool $referencesSupported): void
    {
        $this->referencesSupported = $referencesSupported;
    }

    /**
     * @return string|null
     */
    public function getLeadMaximumAssessmentInterval(): ?string
    {
        return $this->leadMaximumAssessmentInterval;
    }

    /**
     * @param string|null $leadMaximumAssessmentInterval
     */
    public function setLeadMaximumAssessmentInterval(?string $leadMaximumAssessmentInterval): void
    {
        $this->leadMaximumAssessmentInterval = $leadMaximumAssessmentInterval;
    }

    /**
     * @return string|null
     */
    public function getLeadAverageAssessmentInterval(): ?string
    {
        return $this->leadAverageAssessmentInterval;
    }

    /**
     * @param string|null $leadAverageAssessmentInterval
     */
    public function setLeadAverageAssessmentInterval(?string $leadAverageAssessmentInterval): void
    {
        $this->leadAverageAssessmentInterval = $leadAverageAssessmentInterval;
    }

    /**
     * @return string|null
     */
    public function getSaleMaximumAssessmentInterval(): ?string
    {
        return $this->saleMaximumAssessmentInterval;
    }

    /**
     * @param string|null $saleMaximumAssessmentInterval
     */
    public function setSaleMaximumAssessmentInterval(?string $saleMaximumAssessmentInterval): void
    {
        $this->saleMaximumAssessmentInterval = $saleMaximumAssessmentInterval;
    }

    /**
     * @return string|null
     */
    public function getSaleAverageAssessmentInterval(): ?string
    {
        return $this->saleAverageAssessmentInterval;
    }

    /**
     * @param string|null $saleAverageAssessmentInterval
     */
    public function setSaleAverageAssessmentInterval(?string $saleAverageAssessmentInterval): void
    {
        $this->saleAverageAssessmentInterval = $saleAverageAssessmentInterval;
    }

    /**
     * @return string
     */
    public function getAttributionModelLead(): string
    {
        return $this->attributionModelLead;
    }

    /**
     * @param string $attributionModelLead
     */
    public function setAttributionModelLead(string $attributionModelLead): void
    {
        if (!in_array($attributionModelLead, static::$attributionsEnum)) {
            throw new \ErrorException($attributionModelLead . ' Nieznany typ');
        }
        $this->attributionModelLead = $attributionModelLead;
    }

    /**
     * @return string
     */
    public function getAttributionModelSales(): string
    {
        return $this->attributionModelSales;
    }

    /**
     * @param string $attributionModelSales
     */
    public function setAttributionModelSales(string $attributionModelSales): void
    {
        if (!in_array($attributionModelSales, static::$attributionsEnum)) {
            throw new \ErrorException($attributionModelSales . ' Nieznany typ');
        }
        $this->attributionModelSales = $attributionModelSales;
    }

    /**
     * @return float
     */
    public function getCps(): float
    {
        return $this->getSaleCommissionVariable();
    }

    /**
     * @return float
     */
    public function getCpc(): float
    {
        return $this->getClickCommission();
    }

    /**
     * @param string $externalId
     */
    public function setExternalId($externalId): void
    {
        $this->externalId = $externalId;
    }
}
