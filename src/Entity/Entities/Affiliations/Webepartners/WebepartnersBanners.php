<?php
namespace App\Entity\Entities\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\OffersAffiliation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class WebepartnersBanners
 * @ORM\Table(name="webepartners_banners")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Webepartners\WebepartnersBannersRepository")
 */
class WebepartnersBanners extends OffersAffiliation implements OfferBannerInterface
{

    /**
     * @var int $programId
     * @ORM\Column(name="program_id", type="integer", nullable=false)
     */
    protected $programId;

    /**
     * @var string $bannerId
     * @ORM\Column(name="banner_id", type="string", length=50, nullable=false, unique=true)
     */
    protected $bannerId;

    /**
     * @var string|null $shortBannerId
     * @ORM\Column(name="short_banner_id", type="string", length=50, nullable=true)
     */
    protected $shortBannerId;

    /**
     * @var int $width
     * @ORM\Column(name="width", type="integer", length=5, nullable=false)
     */
    protected $width;

    /**
     * @var int $height
     * @ORM\Column(name="height", type="integer", length=5, nullable=false)
     */
    protected $height;

    /**
     * @var \DateTime $publicDate
     * @ORM\Column(name="public_date", type="datetime", nullable=false)
     */
    protected $publicDate;

    /**
     * @var \DateTime|null $unpublicDate
     * @ORM\Column(name="unpublic_date", type="datetime", nullable=true)
     */
    protected $unpublicDate;

    /**
     * @var string|null $landingUrl
     * @ORM\Column(name="landing_url", type="string", length=200, nullable=true)
     */
    protected $landingUrl;

    /**
     * @var string|null $fileMime
     * @ORM\Column(name="file_mime", type="string", length=20, nullable=true)
     */
    protected $fileMime;

    /**
     * @var string|null $bannerImageUrl
     * @ORM\Column(name="banner_image_url", type="string", length=700, nullable=true)
     */
    protected $bannerImageUrl;

    /**
     * @var string|null $bannerTrackingUrl
     * @ORM\Column(name="banner_tracking_url", type="string", length=700, nullable=true)
     */
    protected $bannerTrackingUrl;

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
    public function getBannerId(): string
    {
        return $this->bannerId;
    }

    /**
     * @param string $bannerId
     */
    public function setBannerId(string $bannerId): void
    {
        $this->bannerId = $bannerId;
    }

    /**
     * @return string|null
     */
    public function getShortBannerId(): ?string
    {
        return $this->shortBannerId;
    }

    /**
     * @param string|null $shortBannerId
     */
    public function setShortBannerId(?string $shortBannerId): void
    {
        $this->shortBannerId = $shortBannerId;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return \DateTime
     */
    public function getPublicDate(): \DateTime
    {
        return $this->publicDate;
    }

    /**
     * @param \DateTime $publicDate
     */
    public function setPublicDate($publicDate): void
    {
        if (is_string($publicDate)) {
            $this->publicDate = new \DateTime($publicDate);
        } elseif ($publicDate instanceof \DateTime) {
            $this->publicDate = $publicDate;
        }
    }

    /**
     * @return \DateTime|null
     */
    public function getUnpublicDate(): ?\DateTime
    {
        return $this->unpublicDate;
    }

    /**
     * @param \DateTime|string|null $unpublicDate
     */
    public function setUnpublicDate($unpublicDate): void
    {
        if (is_string($unpublicDate)) {
            $this->unpublicDate = new \DateTime($unpublicDate);
        } elseif ($unpublicDate instanceof \DateTime) {
            $this->unpublicDate = $unpublicDate;
        } elseif (is_null($unpublicDate)) {
            $this->unpublicDate = null;
        }
    }

    /**
     * @return string|null
     */
    public function getLandingUrl(): ?string
    {
        return $this->landingUrl;
    }

    /**
     * @param string|null $landingUrl
     */
    public function setLandingUrl(?string $landingUrl): void
    {
        $this->landingUrl = $landingUrl;
    }

    /**
     * @return string|null
     */
    public function getFileMime(): ?string
    {
        return $this->fileMime;
    }

    /**
     * @param string|null $fileMime
     */
    public function setFileMime(?string $fileMime): void
    {
        $this->fileMime = $fileMime;
    }

    /**
     * @return string|null
     */
    public function getBannerImageUrl(): ?string
    {
        return $this->bannerImageUrl;
    }

    /**
     * @param string|null $bannerImageUrl
     */
    public function setBannerImageUrl(?string $bannerImageUrl): void
    {
        $this->bannerImageUrl = $bannerImageUrl;
    }

    /**
     * @return string|null
     */
    public function getBannerTrackingUrl(): ?string
    {
        return $this->bannerTrackingUrl;
    }

    /**
     * @param string|null $bannerTrackingUrl
     */
    public function setBannerTrackingUrl(?string $bannerTrackingUrl): void
    {
        $this->bannerTrackingUrl = $bannerTrackingUrl;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return '';
    }

    /**
     */
    public function getContent(): string
    {
        return '';
    }

    /**
     * @return \DateTime
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeFrom(): \DateTime
    {
        return $this->getPublicDate();
    }

    /**
     * @return \DateTime|null
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeTo(): ?\DateTime
    {
        return $this->getUnpublicDate();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlTracking(): string
    {
        return $this->getBannerTrackingUrl();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlImage(): string
    {
        return $this->getBannerImageUrl();
    }
}
