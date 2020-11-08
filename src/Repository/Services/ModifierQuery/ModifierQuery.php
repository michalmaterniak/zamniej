<?php
namespace App\Repository\Services\ModifierQuery;

use App\Repository\Services\Managers\LeftJoinsManagerService;
use App\Repository\Services\ModifierQuery\Interfaces\ModifierQueryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use ErrorException;

abstract class ModifierQuery implements ModifierQueryInterface
{
    /**
     * @var QueryBuilder $queryBuilder
     */
    protected $queryBuilder;

    /**
     * @var string $rootAlias
     */
    protected $rootAlias;

    /**
     * @var EntityManager $entitymanager
     */
    protected $entityManager;

    /**
     * @var LeftJoinsManagerService $leftJoinManager
     */
    private $leftJoinManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function setQueryBuilder($queryBuilder, $rootAlias = null)
    {
        $this->queryBuilder = $queryBuilder;
        if ($rootAlias !== null || !empty($this->queryBuilder->getRootAliases()[0])) {
            $this->rootAlias = $rootAlias ? $rootAlias : $this->queryBuilder->getRootAliases()[0];
        } else {
            throw new ErrorException('Root Aliases is not defined');
        }
    }

    /**
     * @return LeftJoinsManagerService
     */
    public function getLeftJoinManager(): LeftJoinsManagerService
    {
        return $this->leftJoinManager;
    }

    /**
     * @param LeftJoinsManagerService $leftJoinManager
     * @required
     */
    public function setLeftJoinManager(LeftJoinsManagerService $leftJoinManager): void
    {
        $this->leftJoinManager = $leftJoinManager;
    }

    /**
     * @param string $column
     * @param null   $rootAlias
     * @return bool|string
     * @throws ErrorException
     */
    public function isJoinSelected(string $column, $rootAlias = null)
    {
        $alias = $this->rootAlias;
        if ($rootAlias != null) {
            $alias = $rootAlias;
        }

        $joins = $this->queryBuilder->getDQLPart('join');
        if (!empty($joins[$alias])) {
            foreach ($joins[$alias] as $join) {
                /**
                 * @var Join $join
                 */
                if ($join->getJoin() === $alias.'.'.$column) {
                    return $join->getAlias();
                }
            }
        }

        return false;
        //throw new \ErrorException("Left Join Not found");
    }

    public function getEntityClass()
    {
        $entities = $this->queryBuilder->getRootEntities();

        return $entities[0];
    }
    protected function addLeftJoin(string $left, ?string $rootAlias = null) : string
    {
        return $this->getLeftJoinManager()->addLeftJoin($this->queryBuilder, $left, $rootAlias);
    }
}
