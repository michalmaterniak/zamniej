<?php

namespace App\Application\Affiliations\Convertiser;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;

abstract class OffersConvertiserFactory
{
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
     * @param int|ConvertiserPrograms $programId
     */
    abstract public function findOffers($programId): void;
}
