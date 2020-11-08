<?php
namespace App\Repository\Repositories\Shops\Opinions;

use App\Entity\Entities\Shops\Opinions\ShopOpinions as Entity;
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
class ShopOpinionsRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function bySubpage(Subpages $subpage)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.subpage = :subpage")->setParameter('subpage', $subpage);
        return $this;
    }
}
