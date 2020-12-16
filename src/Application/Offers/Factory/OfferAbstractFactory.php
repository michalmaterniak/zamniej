<?php
namespace App\Application\Offers\Factory;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\System\Files;
use App\Services\System\EntityServices\Updater\EntityUpdater;

abstract class OfferAbstractFactory
{
    abstract public function getNewOfferEntity(): void;

    /**
     * @var EntityUpdater $entityUpdater
     */
    protected $entityUpdater;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    /**
     * @var Offers $offer
     */
    protected $offer;

    public function __construct(
        EntityUpdater $entityUpdater,
        ImageManager $imageManager
    )
    {
        $this->entityUpdater = $entityUpdater;
        $this->imageManager = $imageManager;
    }

    protected function createPhoto(): void
    {
        $photo = new Files();
        $photo->setGroup('offer');
        $photo->setPath($this->offer->getSubpage()->getPhoto('logo')->getPath());
        $photo->setData($this->offer->getTitle(), 'alt');

        $this->entityUpdater->getEntityManager()->persist($photo);
        $this->offer->setPhoto($photo);
    }
}
