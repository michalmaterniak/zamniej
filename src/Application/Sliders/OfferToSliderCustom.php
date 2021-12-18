<?php
namespace App\Application\Sliders;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;
use App\Entity\Entities\Shops\Offers\OffersProduct;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use App\Entity\Entities\Sliders\Sliders;

use App\Entity\Entities\Sliders\Slides;
use App\Entity\Entities\Sliders\Slides\SlidesBanners;
use App\Entity\Entities\Sliders\Slides\SlidesProducts;
use App\Entity\Entities\Sliders\Slides\SlidesPromotions;
use App\Entity\Entities\Sliders\Slides\SlidesVouchers;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;

class OfferToSliderCustom extends OfferToSlider
{
    /**
     * @var array $customOffer
     */
    protected $customOffer;
    public function __construct(RequestPostContentData $dataRequest, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->customOffer = $dataRequest->getValue('offer');
    }
    protected function getSlide(Offers $offer)
    {
        if ($offer instanceof OffersVoucher) {
            $slide = new SlidesVouchers();
            $slide->setCode($offer->getCodeText());
        } elseif ($offer instanceof OffersPromotion) {
            $slide = new SlidesPromotions();
        } elseif ($offer instanceof OffersBanner) {
            $slide = new SlidesBanners();
        } elseif ($offer instanceof OffersProduct) {
            $slide = new SlidesProducts();
        } else {
            $slide = new Slides();
        }

        return $slide;
    }
    public function addOfferToSliderCustom(Offers $offer, Sliders $slider)
    {
        $datetimeFrom = (array_key_exists('datetimeFrom', $this->customOffer) && $this->customOffer['datetimeFrom']) ? $this->customOffer['datetimeFrom'] : $offer->getDatetimeFrom();
        $datetimeTo = array_key_exists('datetimeTo', $this->customOffer) ? $this->customOffer['datetimeTo'] : $offer->getDatetimeFrom();
        $content = array_key_exists('content', $this->customOffer) ? $this->customOffer['content'] : $offer->getContent()->getContent();
        $header = array_key_exists('header', $this->customOffer) ? $this->customOffer['header'] : $offer->getTitle();

        $slide = $this->getSlide($offer);

        $slide->setDatetimeFrom($datetimeFrom);
        $slide->setDatetimeTo($datetimeTo);
        $slide->setPhoto($offer->getPhoto());
        $slide->setContent(strip_tags($content));
        $slide->setHeader($header);
        $slide->setLink($offer->getUrl());
        $slide->setOffer($offer);
        $slider->addSlide($slide);
        $this->entityManager->persist($slide);
        $this->entityManager->flush();

        return $slider;
    }
}
