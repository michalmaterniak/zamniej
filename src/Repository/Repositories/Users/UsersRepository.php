<?php
namespace App\Repository\Repositories\Users;

use App\Entity\Entities\Users\Users as Entity;
use App\Repository\Repositories\GlobalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Entity               find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null          findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]             findAllResult()
 * @method Entity[]             findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class UsersRepository extends GlobalRepository
{
    protected function getEntityName()
    {
        return Entity::class;
    }

    /**
     */
    public function findOneAdmin()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.admin = 1")->setMaxResults(1);
        return $this;
    }
}
