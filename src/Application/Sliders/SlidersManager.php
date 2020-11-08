<?php
namespace App\Application\Sliders;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Sliders\Sliders;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;

class SlidersManager
{
    /**
     * @var OfferToSliderCustom $offerToSlider
     */
    protected $offerToSlider;

    /**
     * @var RequestPostContentData $dataRequest
     */
    protected $dataRequest;
    public function __construct(RequestPostContentData $dataRequest, OfferToSliderCustom $toSliderCustom)
    {
        $this->dataRequest = $dataRequest;
        $this->offerToSlider = $toSliderCustom;
    }

    public function addSlideByOffer(Offers $offer, Sliders $slider)
    {
        if ($this->dataRequest->checkIfExist('offer')) {
            $this->offerToSlider->addOfferToSliderCustom($offer, $slider);
        } else {
            $this->offerToSlider->addOfferToSlider($offer, $slider);
        }
    }
}
