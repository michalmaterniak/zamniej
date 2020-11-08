<?php
namespace App\Application\Images;

use App\Application\Files\OfferPath;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Services\Photos\ImageManager as GlobalImageManager;
use Intervention\Image\Exception\NotReadableException;

class ImageManager extends GlobalImageManager
{
    /**
     * @var OfferPath $offerPath
     */
    protected $offerPath;

    /**
     * @param OfferPath $offerPath
     * @required
     */
    public function setOfferPath(OfferPath $offerPath): void
    {
        $this->offerPath = $offerPath;
    }

    /**
     * @param Offers $offer
     * @param $data
     * @param string $name
     * @return string|null
     * @throws \ErrorException
     */
    public function saveAsOffer(Offers $offer, $data, string $name) : ?string
    {
        try {
            return $this->offerPath->getRelativeUploadsPathOffer($offer).$this->saveImage($data, $name, $this->offerPath->getAbsoluteUploadsPathOffer($offer));
        } catch (NotReadableException $exception) {
            return null;
        }
    }
}
