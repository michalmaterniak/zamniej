<?php
namespace App\Repository\Repositories\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersHotPrices;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersHotPrices as Entity;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * @method Entity                   find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null              findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                 findAllResult()
 * @method Entity[]                 findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class WebepartnersHotPricesRepository extends WebepartnersOffersRepository
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
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.webeProductId = :idWebe")
            ->setParameter('idWebe', $idWebe)
        ;
        return $this;
    }

    /**
     * @param ShopsAffiliation|WebepartnersPrograms $program
     * @return WebepartnersHotPrices[]|Paginator
     */
    public function findAllActiveByShopByPercentRabat(ShopsAffiliation $program)
    {
        $q = $this->getEntityManager()->createQueryBuilder();
        $q->select("{$this->getRootAlias()} as product, (100 * {$this->getRootAlias()}.priceCut) / ({$this->getRootAlias()}.productPrice+{$this->getRootAlias()}.priceCut) as rabatPercent")->from($this->getEntityName(), $this->getRootAlias())
            ->andWhere("{$this->getRootAlias()}.shopAffiliation = :shopAffiliation")
            ->setParameter('shopAffiliation', $program)
        ;

        $this->getServicesRepositoriesManager()->getPaginationRequestModifierQuery()->modify($q);
        $this->getServicesRepositoriesManager()->getOrderingRequestModifierQuery()->modify($q);

        $q->orderBy("rabatPercent", 'DESC');

        return new Paginator($q->getQuery());
    }

    /**
     * @param ShopsAffiliation $program
     * @return WebepartnersHotPricesRepository
     * @throws \ErrorException
     */
    public function findAllActiveByShop(ShopsAffiliation $program)
    {
        return parent::findAllActiveByShop($program);
    }

    /**
     * @param array $ids
     * @return WebepartnersHotPricesRepository
     */
    public function findAllByIdsOfferIsNull(array $ids)
    {
        return parent::findAllByIdsOfferIsNull($ids);
    }
}
