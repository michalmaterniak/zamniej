<?php
namespace App\Repository\Repositories\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPromotions as Entity;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Entity                   find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null              findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                 findAllResult()
 * @method Entity[]                 findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class WebepartnersPromotionsRepository extends WebepartnersOffersRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function __construct(
        ManagerRegistry                 $registry,
        ServicesRepositoriesManager     $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @param string $idWebe
     * @return $this
     */
    public function findOneByWebeId(string $idWebe)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.voucherId = :idWebe")
            ->setParameter('idWebe', $idWebe);

        return $this;
    }

    /**
     * @param ShopsAffiliation $program
     * @return WebepartnersPromotionsRepository
     * @throws \ErrorException
     */
    public function findAllActiveByShop(ShopsAffiliation $program)
    {
        return parent::findAllActiveByShop($program);
    }

    /**
     * @param array $ids
     * @return WebepartnersPromotionsRepository
     */
    public function findAllByIdsOfferIsNull(array $ids)
    {
        return parent::findAllByIdsOfferIsNull($ids);
    }
}
