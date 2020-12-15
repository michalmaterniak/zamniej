<?php
namespace App\Application\Sliders;

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
