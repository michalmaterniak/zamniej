<?php
namespace App\Repository\Repositories\Affiliations\Convertiser;

use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPromotions as Entity;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity       find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null  findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]     findAllResult()
 * @method Entity[]     findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class ConvertiserPromotionsRepository extends ConvertiserOffersRepository
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
