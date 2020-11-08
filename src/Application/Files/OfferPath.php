<?php
namespace App\Application\Files;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Services\Files\Path\Interfaces\UploadPathsInterface;
use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Files\Path\UploadsFilesPathSubpage;
use App\Services\Subpages\SlugGenerator\SlugGenerator;

class OfferPath extends UploadsFilesPathSubpage
{
    public function __construct(UploadsFilesPath $uploadsFilesPath, SlugGenerator $nameConverter)
    {
        parent::__construct($uploadsFilesPath, $nameConverter);
    }

    public function getAbsoluteUploadsPathOffer(Offers $offer)
    {
        if ($offer->getShopAffiliation()->getSubpage()) {
            return parent::getAbsoluteUploadsPathSubpage($offer->getShopAffiliation()->getSubpage()).'offers/'.$offer->getIdOffer().'/';
        } else {
            throw new \ErrorException('Subpage have to be defined');
        }
    }

    public function getRelativeUploadsPathOffer(Offers $offer)
    {
        if ($offer->getShopAffiliation()->getSubpage()) {
            return parent::getRelativeUploadsPathSubpage($offer->getShopAffiliation()->getSubpage()).'offers/'.$offer->getIdOffer().'/';
        } else {
            throw new \ErrorException('Subpage have to be defined');
        }
    }
}
