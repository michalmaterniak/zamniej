<?php
namespace App\Repository\Services\ModifierQuery\Resources;

use App\Application\Locale\Locale;
use App\Repository\Services\ModifierQuery\ModifierQuery;
use App\Services\System\Locale\Interfaces\LocaleInterface;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class SlugRequestModifierQuery extends ModifierQuery
{
    protected LocaleInterface       $localeModel;
    protected RequestDataManager    $requestDataManager;

    public function __construct(
        RequestDataManager $requestDataManager,
        Locale $locale,
        EntityManagerInterface $entityManager
    )
    {

        parent::__construct($entityManager);

        $this->localeModel =            $locale;
        $this->requestDataManager =     $requestDataManager;
    }

    public function modify(QueryBuilder $queryBuilder, $rootAlias = null)
    {
        $this->setQueryBuilder($queryBuilder, $rootAlias);
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        if($this->requestDataManager->checkIfExist('idResource'))
        {
            $this->queryBuilder
                ->andWhere("{$this->rootAlias}.idResource = :idResource")
                ->setParameter('idResource', $this->requestDataManager->getValue('idResource'));

        }
        else if($this->requestDataManager->checkIfExist('slug'))
        {
            $this->queryBuilder
                ->andWhere("{$aliasRootSubpages}.locale = :locale")
                ->andWhere("{$aliasRootSubpages}.slug = :slug")
                ->setParameter('locale', $this->localeModel->getLocale())
                ->setParameter('slug', $this->requestDataManager->getValue('slug'));
        }
        else
        {
            throw new \ErrorException('unique value is not defined');
        }
    }
}
