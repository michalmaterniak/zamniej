<?php
namespace App\Repository\Repositories\Settings;

use App\Entity\Entities\Settings\Settings as Entity;
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
class SettingsRepository extends GlobalRepository
{
    protected function getEntityName() : string
    {
        return Entity::class;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function getOneById(string $id)
    {
        $this->queryBuilder->andWhere($this->getRootAlias().'.idSetting = :id')->setParameter('id', $id);
        return $this;
    }

    public function getByTargetOrNull(string $target) : static
    {
        $this->queryBuilder->andWhere(
            $this->getRootAlias().'.target = :target')->setParameter('target', $target
            . "OR " . $this->getRootAlias() . '.target IS NULL'
        );

        return $this;
    }
}
