<?php
namespace App\Services\System\Factory;

use Doctrine\ORM\EntityManagerInterface;

abstract class Factory
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
