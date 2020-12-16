<?php
namespace App\Repository\Services\Managers;

use Doctrine\ORM\QueryBuilder;

class LeftJoinsManagerService
{
    /**
     * @var array|string[] $leftJoins
     */
    protected $leftJoins  = [];

    /**
     * @var QueryBuilder $queryBuilder
     */
    protected $queryBuilder;

    public function clearLeftJoins()
    {
        $this->leftJoins = [];
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $left
     * @param string|null $rootAlias
     * @return string
     */
    public function addLeftJoin(QueryBuilder $queryBuilder, string $left, ?string $rootAlias = null) : string
    {
        $this->setQueryBuilder($queryBuilder);
        $rootAlias = $rootAlias ? $rootAlias : $this->queryBuilder->getRootAliases()[0];

        if(empty($this->leftJoins["{$rootAlias}.{$left}"]))
        {
            $this->leftJoins["{$rootAlias}.{$left}"] = $alias = "{$rootAlias}_{$left}";
            $this->queryBuilder->leftJoin("{$rootAlias}.{$left}", $alias)->addSelect($alias);
            return $alias;
        }
        else
        {
            return $this->leftJoins["{$rootAlias}.{$left}"];
        }
    }

    protected function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }
}
