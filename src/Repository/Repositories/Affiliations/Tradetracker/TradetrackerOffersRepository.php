<?php
namespace App\Repository\Repositories\Affiliations\Tradetracker;

use App\Repository\Repositories\GlobalRepository;

abstract class TradetrackerOffersRepository extends GlobalRepository
{
    /**
     * @return $this
     */
    public function externalId(int $exteralId)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.id = :id")->setParameter('id', $exteralId);
        return $this;
    }
}
