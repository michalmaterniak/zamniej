<?php
namespace App\Application\Affiliations\Webepartners;
use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;

abstract class OffersWebepartnersFactory
{
    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var ArrayCollection $offers
     */
    protected $offers;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;


    /**
     * @var EntityUpdater $entityUpdater
     */
    protected $entityUpdater;

    public function __construct(
        ImageManager $imageManager,
        EntityUpdater $entityUpdater
    )
    {
        $this->imageManager = $imageManager;
        $this->entityUpdater = $entityUpdater;
        $this->offers = new ArrayCollection();
    }

    /**
     * @param int|WebepartnersPrograms $programId
     */
    abstract public function findOffers($programId): void;
}
