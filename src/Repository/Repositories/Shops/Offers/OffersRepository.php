<?php
namespace App\Repository\Repositories\Shops\Offers;

use App\Entity\Entities\Shops\Offers\Offers as Entity;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity                           find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null                      findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                         findAllResult()
 * @method Entity[]                         findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class OffersRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function __construct(
        ManagerRegistry                 $registry,
        ServicesRepositoriesManager     $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @param $affiliations
     * @param null $orderBy
     * @param bool $asc
     * @return $this
     */
    public function findOffersByAffiliations($affiliations, $orderBy = 'idOffer', $ordering = 'ASC')
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.shopAffiliation IN (:affiliations)")
            ->setParameter('affiliations', $affiliations);

        $this->addLeftJoin('content');
        $this->addLeftJoin('photo');
        $this->addLeftJoin('liking');

        $this->queryBuilder->orderBy("{$this->getRootAlias()}.$orderBy ", $ordering);

        return $this;
    }

    /**
     * @param Subpages $subpage
     * @return $this
     */
    public function findOffersBySubpage(Subpages $subpage, $orderBy = 'idOffer', $ordering = 'ASC')
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.subpage = :subpage")
            ->setParameter('subpage', $subpage);

        $this->addLeftJoin('content');
        $this->addLeftJoin('photo');
        $this->addLeftJoin('liking');

        $this->queryBuilder->addOrderBy("{$this->getRootAlias()}.priority ", "DESC");
        $this->queryBuilder->addOrderBy("{$this->getRootAlias()}.$orderBy ", $ordering);
        return $this;
    }

    /**
     * @param int $offer
     * @return $this
     */
    public function getOneOfferByIdWithSubpage(int $offer)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idOffer = :offer")
            ->setParameter('offer', $offer);
        $this->addLeftJoin('subpage');

        return $this;
    }

    public function actualOffer()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.datetimeFrom < :dateNow AND ({$this->getRootAlias()}.datetimeTo > :dateNow OR {$this->getRootAlias()}.datetimeTo IS NULL) ")
            ->setParameter('dateNow', new DateTime());
    }

    public function fullOffer(): self
    {
        $this->addLeftJoin('photo');
        $this->addLeftJoin('content');
        $this->addLeftJoin('liking');
        return $this;
    }

    /**
     * @param string $typeOffer
     * @return $this
     */
    public function offersByType(string $typeOffer)
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()} INSTANCE OF {$typeOffer}");

        return $this;
    }

    /**
     * @param int $idOffer
     * @return $this
     */
    public function getOneOfferById(int $idOffer): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idOffer = :id")
            ->setParameter('id', $idOffer);

        return $this;
    }

    /**
     * @return $this
     */
    public function withShopAffil(): self
    {
        $this->addLeftJoin('shopAffiliation');
        return $this;
    }

    /**
     * @param array|string[] $orderBy
     * @return $this
     */
    public function orderBy(array $orderBy): self
    {
        foreach ($orderBy as $key => $item)
            $this->queryBuilder->addOrderBy("{$this->getRootAlias()}.{$key}", $item);

        return $this;
    }

    /**
     * @return $this
     */
    public function byPageRequest(): self
    {
        $this->getServicesRepositoriesManager()->getPaginationRequestModifierQuery()->modify($this->queryBuilder, 20);
        return $this;
    }

    /**
     * @return $this
     */
    public function withPhoto(): self
    {
        $this->addLeftJoin('photo');
        return $this;
    }

    /**
     * @return $this
     */
    public function withContent(): self
    {
        $this->addLeftJoin('content');
        return $this;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function getTypeOffer(string $className) : self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()} INSTANCE OF {$className}");
        return $this;
    }
    /**
     * @return $this
     */
    public function listigPromotions(): self
    {
        $this->orderBy(['datetimeTo' => 'DESC', 'datetimeFrom' => 'DESC'])
            ->withPhoto()
            ->withShopAffil()
            ->withSubpage()
            ->byPageRequest();
        $this->queryBuilder
            ->andWhere(
                "{$this->getRootAlias()} INSTANCE OF " . OffersPromotion::class . " OR " .
                "{$this->getRootAlias()} INSTANCE OF " . OffersVoucher::class
            );

        $this->addLeftJoin('content');
        return $this;
    }

    /**
     * @param int $countMax
     * @return $this
     */
    public function lastMax(int $countMax): self
    {
        $this->queryBuilder->setMaxResults($countMax);
        return $this;
    }

    /**
     * @return $this
     */
    public function listingHomepage(): self
    {
        $this->orderBy(['datetimeFrom' => 'DESC', 'datetimeCreate' => 'DESC']);
        $this->withPhoto()->withShopAffil()->withContent()->lastMax(16);
        $aliasRootSubpages = $this->addLeftJoin('subpage');
        $this->queryBuilder->andWhere("{$aliasRootSubpages}.active = 1");

        return $this;
    }

    /**
     * @return $this
     */
    public function withSubpage(): self
    {
        $aliasRootSubpages = $this->addLeftJoin('subpage');
        $this->queryBuilder->andWhere("{$aliasRootSubpages}.active = 1");
        return $this;
    }

    /**
     * @return $this
     */
    public function withLiking(): self
    {
        $this->addLeftJoin('liking');
        return $this;
    }
}
