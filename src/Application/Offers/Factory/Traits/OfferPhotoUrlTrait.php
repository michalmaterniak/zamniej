<?php
namespace App\Application\Offers\Factory\Traits;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\System\Files;
use ErrorException;

trait OfferPhotoUrlTrait
{
    /**
     * @param string $url
     * @throws ErrorException
     */
    public function createPhotoByUrl(string $url)
    {
        $imagePath = $this->getImageManager()->saveAsOffer($this->getOffer(), $url, 'offer');
        if ($imagePath) {
            $photo = new Files();
            $photo->setGroup('offer');
            $photo->setPath($imagePath);
            $photo->setData($this->getOffer()->getTitle(), 'alt');
        } else {
            $this->createPhoto();
        }
    }

    /**
     * @return ImageManager
     */
    abstract public function getImageManager(): ImageManager;

    /**
     * @return Offers
     */
    abstract public function getOffer(): Offers;

    abstract protected function createPhoto(): void;

}
