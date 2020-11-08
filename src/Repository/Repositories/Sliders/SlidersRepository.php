<?php
namespace App\Repository\Repositories\Sliders;

use App\Entity\Entities\Sliders\Sliders;
use App\Entity\Entities\Sliders\Sliders as Entity;
use App\Entity\Entities\Sliders\Slides;
use App\Entity\Entities\System\Files;
use App\Repository\Repositories\GlobalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Entity               find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null          findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]             findAllResult()
 * @method Entity[]             findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class SlidersRepository extends GlobalRepository
{
    protected function getEntityName()
    {
        return Entity::class;
    }

    public function indexByName(bool $cache = true)
    {
        $this->start($cache);
        $this->queryBuilder->select($this->getRootAlias())
            ->from($this->getEntityName(), $this->getRootAlias(), "{$this->getRootAlias()}.name")
        ;
        return $this;


    }
    /**
     * @return $this
     */
    public function findAllActiveListing()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.active = 1");
        return $this;
    }

    /**
     * @param int $slider
     * @return $this
     */
    public function findAllSlidesBySlider(int $slider)
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.active = 1")
            ->andWhere("{$this->getRootAlias()}.idSlider = :slider")
            ->setParameter('slider', $slider);

        $aliasRootSlides = $this->addLeftJoin('slides');
        $this->addLeftJoin('photo', $aliasRootSlides);

        return $this;
    }

    /**
     * @param array $names
     * @return $this
     */
    public function getSlidersByNames(array $names)
    {
        $this->queryBuilder            ->andWhere("{$this->getRootAlias()}.active = 1")
            ->andWhere("{$this->getRootAlias()}.name IN (:names)")
            ->setParameter('names', $names)
        ;

        $aliasRootSlides = $this->addLeftJoin('slides');
        $this->addLeftJoin('photo', $aliasRootSlides);

        return $this;
    }
}
