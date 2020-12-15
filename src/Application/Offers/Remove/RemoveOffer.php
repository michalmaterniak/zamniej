<?php
namespace App\Application\Offers\Remove;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Repository\Repositories\System\Files\PhotosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class RemoveOffer
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var PhotosRepository $photosRepository
     */
    protected $photosRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        PhotosRepository $photosRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->photosRepository = $photosRepository;
    }

    public function removeOffer(Offers $offer): bool
    {
        try {
            $this->entityManager->beginTransaction();
            $content = $offer->getContent();

            if ($offer->getPhoto() && $this->pathCountMoreThan($offer->getPhoto()->getPath())) {
                // jedyny path w bazie
                $this->entityManager->remove($offer->getPhoto());
            }

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

    protected function pathCountMoreThan(string $path, int $count = 1): bool
    {
        return $this->photosRepository->counting()->byPath($path)->getCount() === $count;
    }
}
