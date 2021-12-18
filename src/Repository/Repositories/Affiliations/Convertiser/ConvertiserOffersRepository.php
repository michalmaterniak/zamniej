<?php
namespace App\Repository\Repositories\Affiliations\Convertiser;

use App\Repository\Repositories\GlobalRepository;

abstract class ConvertiserOffersRepository extends GlobalRepository
{
    /**
     * @return $this
     */
    public function externalId(string $exteralId)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.id = :id")->setParameter('id', $exteralId);
        return $this;
    }
}
