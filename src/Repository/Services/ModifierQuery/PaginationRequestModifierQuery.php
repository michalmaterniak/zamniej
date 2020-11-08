<?php
namespace App\Repository\Services\ModifierQuery;

use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use ErrorException;

class PaginationRequestModifierQuery extends ModifierQuery
{
    protected $defaultPage = 1;
    protected $defaultMaxResult = 50;

    /**
     * @var RequestDataManager $requestDataManager
     */
    protected $requestDataManager;

    public function __construct(RequestDataManager $requestDataManager, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->requestDataManager =     $requestDataManager;
    }


    /**
     * @var int $offset
     */
    protected $offset = 1;

    /**
     * @var int $maxResult
     */
    protected $maxResult = 50;

    /**
     * @var int $page
     */
    protected $page = 1;

    protected function setByDataRequest()
    {
        if ($this->requestDataManager->checkIfExist('maxResult')) {
            $this->setMaxResult($this->requestDataManager->getValue('maxResult'));
        }

        if ($this->requestDataManager->checkIfExist('page')) {
            $this->setPage($this->requestDataManager->getValue('page'));
        }
    }

    public function setPaginationByRequestModify()
    {
        $this->offset = (($this->page - 1) * $this->maxResult);

        $this->queryBuilder->setFirstResult($this->offset)->setMaxResults($this->maxResult);
    }

//    public function setOrdering()
//    {
//
//        $meta = $this->entityManager->getClassMetadata($this->getEntityClass());
//        $this->queryBuilder->orderBy($this->rootAlias.'.'.$meta->getSingleIdentifierFieldName(), 'ASC');
//    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param int|null $maxCount
     * @param int|null $forcePage
     * @throws ErrorException
     */
    public function modify(QueryBuilder $queryBuilder, ?int $maxCount = null, ?int $forcePage = null)
    {
        $this->setQueryBuilder($queryBuilder);
        $this->setByDataRequest();
        if ($maxCount && is_numeric($maxCount)) {
            $this->setMaxResult($maxCount);
        }
        if ($forcePage && is_numeric($forcePage)) {
            $this->setPage($forcePage);
        }

        $this->setPaginationByRequestModify();
    }

    /**
     * @param int $maxResult
     */
    public function setMaxResult(int $maxResult): void
    {
        $this->maxResult = $maxResult;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }
}
