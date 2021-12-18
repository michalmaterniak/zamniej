<?php

namespace App\Application\Affiliations\Tradetracker;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;

abstract class OffersTradetrackerFactory
{
    /**
     * @var ArrayCollection
     */
    protected $offers;

    public function __construct(
        protected ImageManager $imageManager,
        protected EntityUpdater $entityUpdater
    )
    {
        $this->offers = new ArrayCollection();
    }

    /**
     * @param int|TradetrackerPrograms $programId
     */
    abstract public function findOffers($programId): void;
}
