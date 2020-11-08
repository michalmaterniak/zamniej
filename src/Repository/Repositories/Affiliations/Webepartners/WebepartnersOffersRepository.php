<?php
namespace App\Repository\Repositories\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Repository\Repositories\GlobalRepository;

abstract class WebepartnersOffersRepository extends GlobalRepository
{
    /**
     * @param ShopsAffiliation $shopAffiliation
     * @return $this
     * @throws \ErrorException
     */
    public function findAllActiveByShop(ShopsAffiliation $shopAffiliation)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.shopAffiliation = :shopAffiliation")
            ->setParameter('shopAffiliation', $shopAffiliation)
        ;

        $this->getServicesRepositoriesManager()->getPaginationRequestModifierQuery()->modify($this->queryBuilder);
        $this->getServicesRepositoriesManager()->getOrderingRequestModifierQuery()->modify($this->queryBuilder);

        return $this;
    }

    /**
     * @param array|int[] $ids
     */
    public function findAllByIdsOfferIsNull(array $ids)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idOffer IN (:offers)")
            ->setParameter('offers', $ids)
            ->andWhere("{$this->getRootAlias()}.offer IS NULL")
        ;
        return $this;
    }
}
