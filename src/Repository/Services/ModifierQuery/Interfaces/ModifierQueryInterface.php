<?php


namespace App\Repository\Services\ModifierQuery\Interfaces;

use Doctrine\ORM\QueryBuilder;

interface ModifierQueryInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @return void
     */
    public function modify(QueryBuilder $queryBuilder);
}
