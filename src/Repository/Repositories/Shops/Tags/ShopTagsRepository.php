<?php
namespace App\Repository\Repositories\Shops\Tags;

use App\Entity\Entities\Shops\Tags\ShopTags as Entity;
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
class ShopTagsRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }


    public function findAllWithTags()
    {
        $this->addLeftJoin('tags');
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function findOneByNameTag(string $name, string $locale)
    {
        $leftRootTags = $this->addLeftJoin('tags');
        $this->queryBuilder->andWhere("{$leftRootTags}.name = :name")->setParameter('name', $name);
        $this->queryBuilder->andWhere("{$leftRootTags}.locale = :locale")->setParameter('locale', $locale);

        return $this;
    }
}
