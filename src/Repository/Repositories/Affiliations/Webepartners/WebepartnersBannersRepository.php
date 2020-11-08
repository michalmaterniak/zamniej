<?php
namespace App\Repository\Repositories\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersBanners as Entity;
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
class WebepartnersBannersRepository extends WebepartnersOffersRepository
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
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.bannerId = :idWebe")
            ->setParameter('idWebe', $idWebe);
        return $this;
    }


    /**
     * @param ShopsAffiliation $shopAffiliation
     * @return WebepartnersBannersRepository
     * @throws \ErrorException
     */
    public function findAllActiveByShop(ShopsAffiliation $shopAffiliation)
    {
        return parent::findAllActiveByShop($shopAffiliation);
    }

    /**
     * @param array $ids
     * @return WebepartnersBannersRepository
     */
    public function findAllByIdsOfferIsNull(array $ids)
    {
        return parent::findAllByIdsOfferIsNull($ids);
    }
}
