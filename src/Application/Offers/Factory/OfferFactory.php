<?php
namespace App\Application\Offers\Factory;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\System\Files;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Exception;

class OfferFactory extends OfferAbstractFactory
{
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

    public function getNewOfferEntity(): void
    {
        $this->offer = new Offers();
    }

    /**
     * @param array $data
     * @return Offers
     */
    public function create(array $data): Offers
    {
        try {
            $this->entityUpdater->getEntityManager()->beginTransaction();
            $this->getNewOfferEntity();
            $this->update($data);
            $this->entityUpdater->getEntityManager()->persist($this->offer);
            $this->entityUpdater->getEntityManager()->flush();
            $this->createPhoto();
            $this->entityUpdater->getEntityManager()->commit();
        } catch (Exception $exception) {
            $this->entityUpdater->getEntityManager()->rollback();
        }
        return $this->offer;
    }

    /**
     * @param array $offer
     */
    public function update(array $offer): void
    {
        $this->entityUpdater->setEntity($this->offer);
        $this->entityUpdater->update($offer);
        $this->entityUpdater->getEntityManager()->flush();
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
