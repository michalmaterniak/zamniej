<?php
namespace App\Repository\Services\ModifierQuery;

use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class OrderingRequestModifierQuery extends ModifierQuery
{
    /**
     * @var string $ascending
     */
    protected $ascending = 'ASC';

    /**
     * @var string $orderBy
     */
    protected $orderBy = '';

    /**
     * @var RequestDataManager $requestDataManager
     */
    protected $requestDataManager;

    public function __construct(RequestDataManager $requestDataManager, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->requestDataManager = $requestDataManager;
    }

    protected function setOrdering()
    {

        $meta = $this->entityManager->getClassMetadata($this->getEntityClass());
        $this->orderBy = $meta->getSingleIdentifierFieldName();

        $this->orderBy = $this->requestDataManager->getValue('orderBy', $meta->getSingleIdentifierFieldName());

        if ($this->requestDataManager->checkIfExist('ascending')) {
            $this->ascending = $this->requestDataManager->getValue('ascending');
        }
        $this->queryBuilder->orderBy($this->rootAlias.'.'.$this->orderBy, $this->ascending);
    }

    public function modify(QueryBuilder $queryBuilder)
    {
        $this->setQueryBuilder($queryBuilder);
        $this->setOrdering();
    }
}
