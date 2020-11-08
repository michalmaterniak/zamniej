<?php
namespace App\Repository\Services\ModifierQuery\Resources;

use App\Repository\Services\ModifierQuery\ModifierQuery;
use App\Services\System\Request\Retrievers\RequestData;
use App\Services\System\Request\Retrievers\RequestData\RequestUriData;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class IdParentRequestModifierQuery extends ModifierQuery
{

    protected int $idParent;

    /**
     * @var RequestData $requestData
     */
    protected $requestData;
    public function __construct(RequestUriData $requestUriData, EntityManagerInterface $entityManager )
    {
        parent::__construct($entityManager);
        $this->requestData = $requestUriData;
    }

    public function modify(QueryBuilder $queryBuilder, $rootAlias = null)
    {
        $this->idParent = (int)$this->requestData->getValue('idParent');

        $this->setQueryBuilder($queryBuilder, $rootAlias);

        $queryBuilder->leftJoin("{$this->rootAlias}.parent", 'parent')->addSelect('parent');
        $queryBuilder->andWhere('parent.idResource = :idParent')->setParameter('idParent', $this->idParent);
        $queryBuilder->leftJoin("{$this->rootAlias}.children", 'children')->addSelect('children');
        $queryBuilder->leftJoin('children.admin', 'childrenadmin')->addSelect('childrenadmin');
        $queryBuilder->leftJoin('children.subpages', 'childrensubpages')->addSelect('childrensubpages');

    }

}
