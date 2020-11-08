<?php


namespace App\Application\Offers\Remove;


use App\Entity\Entities\Shops\Offers\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class RemoveOffer
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function removeOffer(Offers $offer): bool
    {
        try {
            $this->entityManager->beginTransaction();
            $content = $offer->getContent();

            //nie usuwamy zdjęc
//            if ($offer->getPhoto() && $offer->getPhoto()->getIdFile() !== $offer->getSubpage()->getPhoto('logo')->getIdFile()) {
//                $this->entityManager->remove($offer->getPhoto());
//            }

            $this->entityManager->remove($offer->getLiking());
            $this->entityManager->remove($content);

            //slides cascade -> set null on slide

            $this->entityManager->flush();
            $this->entityManager->commit();
            return true;
        } catch (Exception $exception) {
            $this->entityManager->rollback();
        }
        return false;
    }
}
