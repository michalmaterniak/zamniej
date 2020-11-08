<?php


namespace App\Application\Offers\Factory;

use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\Interfaces\OffersFactoryInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\System\Files;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use Exception;

class OfferFactory implements OffersFactoryInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        ImageManager $imageManager
    )
    {
        $this->entityManager = $entityManager;
        $this->imageManager = $imageManager;
    }

    public function getOfferEntity(): Offers
    {
        return new Offers();
    }

    public function create(OfferInterface $offer): Offers
    {
        if ($offer->getShopAffiliation()->getSubpage() === null) {
            throw new ErrorException("Subpage have to be defined");
        }
        try {
            $this->entityManager->beginTransaction();
            $newOfferEntity = $this->getOfferEntity();
            $this->update($newOfferEntity, $offer, false);
            $this->entityManager->persist($newOfferEntity);
            $offer->setOffer($newOfferEntity);
            $this->entityManager->flush();

            $this->createPhoto($newOfferEntity, $offer);
            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->rollback();
        }
        return $newOfferEntity;
    }

    public function createPhoto(Offers $offerEntity, OfferInterface $offer)
    {
        $imagePath = $this->imageManager->saveAsOffer($offerEntity, $offer->getUrlImage(), 'offer');
        if ($imagePath) {
            $photo = new Files();
            $photo->setGroup('offer');
            $photo->setPath($imagePath);
            $photo->setData($offerEntity->getTitle(), 'alt');

            $this->entityManager->persist($photo);
            $offerEntity->setPhoto($photo);
            $this->entityManager->flush();
        }
    }

    /**
     * @param Offers         $offerEntity
     * @param OfferInterface $offer
     * @param bool           $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        $offerEntity->setShopAffiliation($offer->getShopAffiliation());
        $offerEntity->setSubpage($offer->getShopAffiliation()->getSubpage());
        $offerEntity->setContent(strip_tags($offer->getContent()));
        $offerEntity->setTitle($offer->getTitle());
        $offerEntity->setDatetimeFrom($offer->getDatetimeFrom());
        $offerEntity->setDatetimeTo($offer->getDatetimeTo());
        $offerEntity->setUrl($offer->getUrlTracking());

        if ($withFlush) {
            $this->entityManager->flush();
        }
    }
}
