<?php
namespace App\Repository\Services\ModifierQuery;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class RequestModifierQuery extends ModifierQuery
{
    protected RequestStack $requestStack;

    /**
     * @var array $contentPost
     */
    protected $contentPost;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->requestStack = $requestStack;
    }
    abstract protected function setByRequest();
    abstract public function modify(QueryBuilder $queryBuilder);
}
