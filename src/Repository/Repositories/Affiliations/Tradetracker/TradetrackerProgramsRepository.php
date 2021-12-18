<?php
namespace App\Repository\Repositories\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms as Entity;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Entity                   find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null              findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                 findAllResult()
 * @method Entity[]                 findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class TradetrackerProgramsRepository extends ShopsAffiliationRepository
{
    protected function getEntityName(): string {
        return Entity::class;
    }
}
