<?php
namespace App\Repository\Repositories\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPromotions as Entity;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity                   find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null              findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                 findAllResult()
 * @method Entity[]                 findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class TradetrackerPromotionsRepository extends TradetrackerOffersRepository
{
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    protected function getEntityName(): string
    {
        return Entity::class;
    }

}
