<?php

namespace App\Entity\Entities\Affiliations\Convertiser;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ConvertiserPrograms
 * @ORM\Table(name="convertiser_programs")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Convertiser\ConvertiserProgramsRepository")
 */
class ConvertiserPrograms extends ShopsAffiliation
{
    /**
     * @var string $id
     * @ORM\Column(name="id", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $id;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $title;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $description;

    /**
     * @var string $excerpt
     * @ORM\Column(name="excerpt", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $excerpt;

    /**
     * @var string $title
     * @ORM\Column(name="logo_thumbnail", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $logoThumbnail;

    /**
     * @var string $previewUrl
     * @ORM\Column(name="preview_url", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $previewUrl;

    /**
     * @var string $trackingUrl
     * @ORM\Column(name="tracking_url", type="string", length=600, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $trackingUrl;

    /**
     * @var array $categories
     * @ORM\Column(name="categories", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $categories;

    /**
     * @var array $categoriesDetails
     * @ORM\Column(name="categories_details", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $categoriesDetails;

    /**
     * @var string $status
     * @ORM\Column(name="status", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $status;

    /**
     * @var string $status_name
     * @ORM\Column(name="status_name", type="string", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $statusName;

    /**
     * @var DateTime $createdAt
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $createdAt;

    /**
     * @var bool $isFeatured
     * @ORM\Column(name="is_featured", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $isFeatured;

    /**
     * @var string $currency
     * @ORM\Column(name="currency", type="string", length=5, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $currency;

    /**
     * @var array $currencyDetails
     * @ORM\Column(name="currency_details", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $currencyDetails;

    /**
     * @var int $clickSessionLifespan
     * @ORM\Column(name="click_session_lifespan", type="integer", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $clickSessionLifespan;

    /**
     * @var string $terms
     * @ORM\Column(name="terms", type="text", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $terms;

    /**
     * @var bool $policyIncentivized
     * @ORM\Column(name="policy_incentivized", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyIncentivized;

    /**
     * @var bool $policyCashback
     * @ORM\Column(name="policy_cashback", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyCashback;

    /**
     * @var bool $policyCoupons
     * @ORM\Column(name="policy_coupons", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyCoupons;

    /**
     * @var bool $policySearchMarketing
     * @ORM\Column(name="policy_search_marketing", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policySearchMarketing;

    /**
     * @var bool $policyEmailMarketing
     * @ORM\Column(name="policy_email_marketing", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policyEmailMarketing;

    /**
     * @var bool $policySocialMedia
     * @ORM\Column(name="policy_social_media", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $policySocialMedia;

    /**
     * @var array $geoTargets
     * @ORM\Column(name="geo_targets", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $geoTargets;

    /**
     * @var array $geoTargetsDetails
     * @ORM\Column(name="geo_targets_details", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $geoTargetsDetails;

    /**
     * @var bool $enforceGeoTargeting
     * @ORM\Column(name="enforce_geo_targeting", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $enforceGeoTargeting;

    /**
     * @var array $goals
     * @ORM\Column(name="goals", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $goals;

    /**
     * @var array $stats
     * @ORM\Column(name="stats", type="json", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $stats;

    /**
     * @var bool $hasCoupons
     * @ORM\Column(name="has_coupons", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $hasCoupons;

    /**
     * @var bool $hasProducts
     * @ORM\Column(name="has_products", type="boolean", nullable=false)
     * @Groups({"program-admin"})
     */
    protected $hasProducts;

    /**
     * @var float $cpcRate
     * @ORM\Column(name="cpc_rate", type="decimal", precision=10, scale=2, nullable=false)
     * @Groups({"program-admin"})
     */
    protected $cpcRate;

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
        $this->setExternalId($id);
    }

    /**
     * @param string $externalId
     */
    public function setExternalId($externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return string
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
        $this->setName($title);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * @param string $excerpt
     */
    public function setExcerpt(string $excerpt): void
    {
        $this->excerpt = $excerpt;
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
        $this->setUrlLogo($logoThumbnail);
    }

    /**
     * @return string
     */
    public function getPreviewUrl(): string
    {
        return $this->previewUrl;
    }

    /**
     * @param string $previewUrl
     */
    public function setPreviewUrl(string $previewUrl): void
    {
        $this->previewUrl = $previewUrl;
    }

    /**
     * @return string
     */
    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }

    /**
     * @param string $trackingUrl
     */
    public function setTrackingUrl(string $trackingUrl): void
    {
        $this->trackingUrl = $trackingUrl;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
        if ($status === 'enabled') {
            $this->setEnable(true);
        }
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * @param string $statusName
     */
    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string|DateTime $createdAt
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
    public function isFeatured(): bool
    {
        return $this->isFeatured;
    }

    /**
     * @param bool $isFeatured
     */
    public function setIsFeatured(bool $isFeatured): void
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public function getCurrencyDetails(): array
    {
        return $this->currencyDetails;
    }

    /**
     * @param array $currencyDetails
     */
    public function setCurrencyDetails(array $currencyDetails): void
    {
        $this->currencyDetails = $currencyDetails;
    }

    /**
     * @return int
     */
    public function getClickSessionLifespan(): int
    {
        return $this->clickSessionLifespan;
    }

    /**
     * @param int $clickSessionLifespan
     */
    public function setClickSessionLifespan(int $clickSessionLifespan): void
    {
        $this->clickSessionLifespan = $clickSessionLifespan;
    }

    /**
     * @return string
     */
    public function getTerms(): string
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     */
    public function setTerms(string $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @return bool
     */
    public function isPolicyIncentivized(): bool
    {
        return $this->policyIncentivized;
    }

    /**
     * @param bool $policyIncentivized
     */
    public function setPolicyIncentivized(bool $policyIncentivized): void
    {
        $this->policyIncentivized = $policyIncentivized;
    }

    /**
     * @return bool
     */
    public function isPolicyCashback(): bool
    {
        return $this->policyCashback;
    }

    /**
     * @param bool $policyCashback
     */
    public function setPolicyCashback(bool $policyCashback): void
    {
        $this->policyCashback = $policyCashback;
    }

    /**
     * @return bool
     */
    public function isPolicyCoupons(): bool
    {
        return $this->policyCoupons;
    }

    /**
     * @param bool $policyCoupons
     */
    public function setPolicyCoupons(bool $policyCoupons): void
    {
        $this->policyCoupons = $policyCoupons;
    }

    /**
     * @return bool
     */
    public function isPolicySearchMarketing(): bool
    {
        return $this->policySearchMarketing;
    }

    /**
     * @param bool $policySearchMarketing
     */
    public function setPolicySearchMarketing(bool $policySearchMarketing): void
    {
        $this->policySearchMarketing = $policySearchMarketing;
    }

    /**
     * @return bool
     */
    public function isPolicyEmailMarketing(): bool
    {
        return $this->policyEmailMarketing;
    }

    /**
     * @param bool $policyEmailMarketing
     */
    public function setPolicyEmailMarketing(bool $policyEmailMarketing): void
    {
        $this->policyEmailMarketing = $policyEmailMarketing;
    }

    /**
     * @return bool
     */
    public function isPolicySocialMedia(): bool
    {
        return $this->policySocialMedia;
    }

    /**
     * @param bool $policySocialMedia
     */
    public function setPolicySocialMedia(bool $policySocialMedia): void
    {
        $this->policySocialMedia = $policySocialMedia;
    }

    /**
     * @return array
     */
    public function getGeoTargets(): array
    {
        return $this->geoTargets;
    }

    /**
     * @param array $geoTargets
     */
    public function setGeoTargets(array $geoTargets): void
    {
        $this->geoTargets = $geoTargets;
    }

    /**
     * @return array
     */
    public function getGeoTargetsDetails(): array
    {
        return $this->geoTargetsDetails;
    }

    /**
     * @param array $geoTargetsDetails
     */
    public function setGeoTargetsDetails(array $geoTargetsDetails): void
    {
        $this->geoTargetsDetails = $geoTargetsDetails;
    }

    /**
     * @return bool
     */
    public function isEnforceGeoTargeting(): bool
    {
        return $this->enforceGeoTargeting;
    }

    /**
     * @param bool $enforceGeoTargeting
     */
    public function setEnforceGeoTargeting(bool $enforceGeoTargeting): void
    {
        $this->enforceGeoTargeting = $enforceGeoTargeting;
    }

    /**
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    /**
     * @param array $stats
     */
    public function setStats(array $stats): void
    {
        $this->stats = $stats;
    }

    /**
     * @return bool
     */
    public function isHasCoupons(): bool
    {
        return $this->hasCoupons;
    }

    /**
     * @param bool $hasCoupons
     */
    public function setHasCoupons(bool $hasCoupons): void
    {
        $this->hasCoupons = $hasCoupons;
    }

    /**
     * @return bool
     */
    public function isHasProducts(): bool
    {
        return $this->hasProducts;
    }

    /**
     * @param bool $hasProducts
     */
    public function setHasProducts(bool $hasProducts): void
    {
        $this->hasProducts = $hasProducts;
    }

    /**
     * @return float
     */
    public function getCps(): float
    {
        foreach ($this->getGoals() as $goal) {
            if ($goal['status'] === 'enabled' && $goal['title'] === 'Sprzedaż') {
                return floatval($goal['payout']);
            }
        }

        return 0;
    }

    /**
     * @return array
     */
    public function getGoals(): array
    {
        return $this->goals;
    }

    /**
     * @param array $goals
     */
    public function setGoals(array $goals): void
    {
        $this->goals = $goals;
    }

    /**
     * @return float
     */
    public function getCpc(): float
    {
        return $this->getCpcRate();
    }

    /**
     * @return float
     */
    public function getCpcRate(): float
    {
        return $this->cpcRate;
    }

    /**
     * @param float $cpcRate
     */
    public function setCpcRate(float $cpcRate): void
    {
        $this->cpcRate = $cpcRate;
    }
}
