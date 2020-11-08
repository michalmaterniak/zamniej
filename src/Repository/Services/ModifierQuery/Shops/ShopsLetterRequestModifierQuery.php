<?php
namespace App\Repository\Services\ModifierQuery\Shops;

use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ModifierQuery\ModifierQuery;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ShopsLetterRequestModifierQuery extends ModifierQuery
{
    protected RequestDataManager    $requestDataManager;

    public function __construct(RequestDataManager $requestDataManager, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->requestDataManager =     $requestDataManager;
    }

    public function modify(QueryBuilder $queryBuilder, $rootAlias = null)
    {
        $this->setQueryBuilder($queryBuilder, $rootAlias);

        $subpagesAlias = GlobalRepository::getAlias(ShopsSubpage::class);
        $queryBuilder->leftJoin("{$this->rootAlias}.subpages", $subpagesAlias)->addSelect($subpagesAlias);
        $letter = $this->requestDataManager->getValue('letter', null);
        if ($letter !== null) {
            if (is_numeric($letter) && (int) $letter === 0) {
                $queryBuilder->andWhere("REGEXP({$subpagesAlias}.name, :regexp) = true")
                    ->setParameter('regexp', '^[[:digit:]]{1}');
            } else {
                $queryBuilder->andWhere("{$subpagesAlias}.name LIKE :letter")->setParameter('letter', $letter.'%');
            }
        }

        $queryBuilder->orderBy("$subpagesAlias.name", 'ASC');
    }
}
