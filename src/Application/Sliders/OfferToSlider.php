<?php


namespace App\Application\Sliders;

use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Sliders\Sliders;
use App\Entity\Entities\Sliders\Slides;
use Doctrine\ORM\EntityManagerInterface;

class OfferToSlider
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
