<?php
namespace App\Repository\Services\ModifierQuery\Resources;

use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ModifierQuery\ModifierQuery;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class IdResourceRequestModifierQuery extends ModifierQuery
{
    protected int $idResource;
    /**
     * @var RequestDataManager $requestData
     */
    protected $requestData;
    public function __construct(RequestDataManager $requestDataManager, EntityManagerInterface $entityManager )
    {
        parent::__construct($entityManager);
        $this->requestData = $requestDataManager;
    }

    public function modify(QueryBuilder $queryBuilder, $rootAlias = null)
    {
        if(!$this->requestData->checkIfExist('idResource'))
        {
            throw new \ErrorException("Id Resource have to be defined in RequestData");
        }
        $this->idResource = (int)$this->requestData->getValue('idResource');

        $this->setQueryBuilder($queryBuilder, $rootAlias);
        $subpagesAlias = GlobalRepository::getAlias(Subpages::class);
        $this->queryBuilder
            ->leftJoin("{$this->rootAlias}.subpages", $subpagesAlias)->addSelect($subpagesAlias);

        $this->queryBuilder
            ->andWhere("{$subpagesAlias}.idResource = :idResource")
            ->setParameter('idResource', $this->idResource);


    }

}
