<?php
namespace App\Repository\Repositories\Subpages;

use App\Entity\Entities\Subpages\SubpageOffers as Entity;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\GlobalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Entity                           find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null                      findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                         findAllResult()
 * @method Entity[]                         findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class SubpageOffersRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    /**
     * @return $this
     */
    public function findBySubpage(Subpages $subpage) : static {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.subpage = :subpage")->setParameter('subpage', $subpage);
        return $this;
    }

    /**
     * @param string $typeOffer
     * @return $this
     */
    public function byType(string $typeOffer)
    {
        $offerLeft = $this->addLeftJoin('offer');

        $this->queryBuilder->andWhere(
            "{$offerLeft} INSTANCE OF $typeOffer"
        );
        $this->queryBuilder->andWhere("{$offerLeft}.datetimeFrom < :dateNow AND ({$offerLeft}.datetimeTo > :dateNow OR {$offerLeft}.datetimeTo IS NULL) ")
            ->setParameter('dateNow', new \DateTime());
        $this->addLeftJoin('photo', $offerLeft);
        $this->addLeftJoin('shopAffiliation', $offerLeft);
        $this->addLeftJoin('content', $offerLeft);

        $aliasRootSubpage = $this->addLeftJoin('subpage', $offerLeft);
        $this->queryBuilder->andWhere("{$offerLeft}.active = 1 AND {$offerLeft}.accepted = 1");

        $this->queryBuilder->andWhere("{$offerLeft}.priority > 2");
        $aliasResource = $this->addLeftJoin('resource', $aliasRootSubpage);
        $this->addLeftJoin('subpages', $aliasResource);

        return $this;
    }

}
