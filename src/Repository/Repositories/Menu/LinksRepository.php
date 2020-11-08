<?php
namespace App\Repository\Repositories\Menu;

use App\Entity\Entities\Menu\Links as Entity;
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
class LinksRepository extends GlobalRepository
{
    protected function getEntityName() : string
    {
        return Entity::class;
    }
}
