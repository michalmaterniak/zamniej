<?php
namespace App\Entity\Entities\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\Interfaces\OfferProductInterface;
use App\Entity\Entities\Affiliations\OffersAffiliation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class WebepartnersHotPrices
 * @ORM\Table(name="webepartners_hot_prices")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Webepartners\WebepartnersHotPricesRepository")
 */
class WebepartnersHotPrices extends OffersAffiliation implements OfferProductInterface
{
    /**
     * @var string $webeProductId
     * @ORM\Column(name="webe_product_id", type="string", length=100, nullable=true, unique=true)
     */
    protected $webeProductId;

    /**
     * @var string|null $shopProductId
     * @ORM\Column(name="shop_product_id", type="string", length=10, nullable=true)
     */
    protected $shopProductId;

    /**
     * @var string|null $shopCategoryName
     * @ORM\Column(name="shop_category_name", type="string", length=400, nullable=true)
     */
    protected $shopCategoryName;

    /**
     * @var array $category
     * @ORM\Column(name="category", type="json", nullable=false)
     */
    protected $category;

    /**
     * @var string|null $productName
     * @ORM\Column(name="product_name", type="string", length=400, nullable=true)
     */
    protected $productName;

    /**
     * @var string|null $productDescritption
     * @ORM\Column(name="product_descritption", type="text", nullable=true)
     */
    protected $productDescritption = '';

    /**
     * @var array $productImages
     * @ORM\Column(name="product_images", type="json", nullable=false)
     */
    protected $productImages;

    /**
     * @var string|null $productBrand
     * @ORM\Column(name="product_brand", type="string", length=100, nullable=true)
     */
    protected $productBrand;

    /**
     * @var int $programId
     * @ORM\Column(name="program_id", type="integer", nullable=false)
     */
    protected $programId;

    /**
     * @var string|null $programName
     * @ORM\Column(name="program_name", type="string", length=100, nullable=true)
     */
    protected $programName;

    /**
     * @var string|null $programLogoUrl
     * @ORM\Column(name="program_logo_url", type="string", length=200, nullable=true)
     */
    protected $programLogoUrl;

    /**
     * @var string|null $productTrackingUrl
     * @ORM\Column(name="product_tracking_url", type="string", length=700, nullable=true)
     */
    protected $productTrackingUrl;

    /**
     * @var string|null $ean
     * @ORM\Column(name="ean", type="string", length=50, nullable=true)
     */
    protected $ean;

    /**
     * @var string|null $isbn
     * @ORM\Column(name="isbn", type="string", length=50, nullable=true)
     */
    protected $isbn;

    /**
     * @var float $productPrice
     * @ORM\Column(name="product_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $productPrice;

    /**
     * @var float $priceCut
     * @ORM\Column(name="price_cut", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $priceCut;

    /**
     * @var array $previousPrice
     * @ORM\Column(name="previous_price", type="json", nullable=false)
     */
    protected $previousPrice;

    /**
     * @return string
     */
    public function getWebeProductId(): string
    {
        return $this->webeProductId;
    }

    /**
     * @param string $webeProductId
     */
    public function setWebeProductId(string $webeProductId): void
    {
        $this->webeProductId = $webeProductId;
    }

    /**
     * @return string|null
     */
    public function getShopProductId(): ?string
    {
        return $this->shopProductId;
    }

    /**
     * @param string|null $shopProductId
     */
    public function setShopProductId(?string $shopProductId): void
    {
        $this->shopProductId = $shopProductId;
    }

    /**
     * @return string|null
     */
    public function getShopCategoryName(): ?string
    {
        return $this->shopCategoryName;
    }

    /**
     * @param string|null $shopCategoryName
     */
    public function setShopCategoryName(?string $shopCategoryName): void
    {
        $this->shopCategoryName = $shopCategoryName;
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
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string|null $productName
     */
    public function setProductName(?string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string|null
     */
    public function getProductDescritption(): ?string
    {
        return $this->productDescritption;
    }

    /**
     * @param string|null $productDescritption
     */
    public function setProductDescritption(?string $productDescritption): void
    {
        $this->productDescritption = $productDescritption;
    }

    /**
     * @return array
     */
    public function getProductImages(): array
    {
        return $this->productImages;
    }

    /**
     * @param array $productImages
     */
    public function setProductImages(array $productImages): void
    {
        $this->productImages = $productImages;
    }

    /**
     * @return string|null
     */
    public function getProductBrand(): ?string
    {
        return $this->productBrand;
    }

    /**
     * @param string|null $productBrand
     */
    public function setProductBrand(?string $productBrand): void
    {
        $this->productBrand = $productBrand;
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
    }

    /**
     * @return string|null
     */
    public function getProductTrackingUrl(): ?string
    {
        return $this->productTrackingUrl;
    }

    /**
     * @param string|null $productTrackingUrl
     */
    public function setProductTrackingUrl(?string $productTrackingUrl): void
    {
        $this->productTrackingUrl = $productTrackingUrl;
    }

    /**
     * @return string|null
     */
    public function getEan(): ?string
    {
        return $this->ean;
    }

    /**
     * @param string|null $ean
     */
    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    /**
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string|null $isbn
     */
    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @param float $productPrice
     */
    public function setProductPrice(float $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @return float
     */
    public function getPriceCut(): float
    {
        return $this->priceCut;
    }

    /**
     * @param float $priceCut
     */
    public function setPriceCut(float $priceCut): void
    {
        $this->priceCut = $priceCut;
    }

    /**
     * @return array
     */
    public function getPreviousPrice(): array
    {
        return $this->previousPrice;
    }

    /**
     * @param array $previousPrice
     */
    public function setPreviousPrice(array $previousPrice): void
    {
        $this->previousPrice = $previousPrice;
    }

    /**
     * @return string|null
     */
    public function getImageUrl()
    {
        if (isset($this->productImages['productImagesUrl']) && count($this->productImages['productImagesUrl']) > 0) {
            return $this->productImages['productImagesUrl'][0];
        }

        return null;
    }


    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getTitle(): string
    {
        return $this->getProductName();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getContent(): string
    {
        return $this->getProductDescritption() ?: '';
    }

    /**
     * @return \DateTime
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeFrom(): \DateTime
    {
        return $this->getDatetimeUpdate();
    }

    /**
     * @return \DateTime|null
     * @Groups({"resource-admin-listing"})
     */
    public function getDatetimeTo(): ?\DateTime
    {
        return null;
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlTracking(): string
    {
        return $this->getProductTrackingUrl();
    }

    /**
     * @return string
     * @Groups({"resource-admin-listing"})
     */
    public function getUrlImage(): string
    {
        return $this->getImageUrl();
    }

    /**
     * @return float
     * @Groups({"resource-admin-listing"})
     */
    public function getCurrentPrice(): float
    {
        return $this->getProductPrice();
    }

    /**
     * @return float
     * @Groups({"resource-admin-listing"})
     */
    public function getCutPrice(): float
    {
        return $this->getPriceCut();
    }

    /**
     * @return float
     * @Groups({"resource-admin-listing"})
     */
    public function getPercentDeal(): float
    {
        return round((100 * $this->getCutPrice()) / ($this->getCurrentPrice() + $this->getCutPrice()), 2);
    }
    public function getHistoryPrices(): ArrayCollection
    {
        // TODO: Implement getHistoryPrices() method.
    }
}
