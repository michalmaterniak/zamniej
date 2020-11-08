<?php
namespace App\Repository\Repositories\Shops\Tags;

use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Entity\Entities\Shops\Tags\ShopTagsTranslate as Entity;
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
class ShopTagsTranslateRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }
}
