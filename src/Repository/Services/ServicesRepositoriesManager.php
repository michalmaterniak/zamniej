<?php
namespace App\Repository\Services;

use App\Repository\Services\Managers\LeftJoinsManagerService;
use App\Repository\Services\ModifierQuery\OrderingRequestModifierQuery;
use App\Repository\Services\ModifierQuery\PaginationRequestModifierQuery;
use App\Repository\Services\ModifierQuery\Resources\IdParentAsIdResourceRequestModifierQuery;
use App\Repository\Services\ModifierQuery\Resources\IdParentRequestModifierQuery;
use App\Repository\Services\ModifierQuery\Resources\IdResourceRequestModifierQuery;
use App\Repository\Services\ModifierQuery\Resources\SlugRequestModifierQuery;
use App\Repository\Services\ModifierQuery\Shops\ShopsLetterRequestModifierQuery;
use App\Services\System\Cache\CacheManager;

class ServicesRepositoriesManager
{

    /**
     * @var IdParentRequestModifierQuery $idParentRequestModifierQuery
     */
    protected $idParentRequestModifierQuery;

    /**
     * @var IdResourceRequestModifierQuery $idResourceRequestModifierQuery
     */
    protected $idResourceRequestModifierQuery;

    /**
     * @var SlugRequestModifierQuery $slugRequestModifierQuery
     */
    protected $slugRequestModifierQuery;

    /**
     * @var IdParentAsIdResourceRequestModifierQuery $idParentAsIdResourceRequestModifierQuery
     */
    protected $idParentAsIdResourceRequestModifierQuery;

    /**
     * @var CacheManager $cache
     */
    protected $cacheManager;

    /**
     * @var PaginationRequestModifierQuery $paginationRequestModifierQuery
     */
    protected $paginationRequestModifierQuery;

    /**
     * @var OrderingRequestModifierQuery $orderingRequestModifierQuery
     */
    protected $orderingRequestModifierQuery;

    /**
     * @var ShopsLetterRequestModifierQuery $shopsLetterRequestModifierQuery
     */
    protected $shopsLetterRequestModifierQuery;

    /**
     * @var LeftJoinsManagerService $leftJoinsManagerService
     */
    protected $leftJoinsManagerService;

    public function __construct(
        ShopsLetterRequestModifierQuery             $shopsLetterRequestModifierQuery,
        SlugRequestModifierQuery                    $slugRequestModifierQuery,
        PaginationRequestModifierQuery              $paginationRequestModifierQuery,
        OrderingRequestModifierQuery                $orderingRequestModifierQuery,
        IdResourceRequestModifierQuery              $idResourceRequestModifierQuery,
        IdParentRequestModifierQuery                $idParentRequestModifierQuery,
        IdParentAsIdResourceRequestModifierQuery    $idParentAsIdResourceRequestModifierQuery,
        LeftJoinsManagerService                     $leftJoinsManagerService,
        CacheManager                                $cacheManager
    ) {
        $this->shopsLetterRequestModifierQuery =                $shopsLetterRequestModifierQuery;
        $this->idResourceRequestModifierQuery =                 $idResourceRequestModifierQuery;
        $this->paginationRequestModifierQuery =                 $paginationRequestModifierQuery;
        $this->orderingRequestModifierQuery =                   $orderingRequestModifierQuery;
        $this->idParentRequestModifierQuery =                   $idParentRequestModifierQuery;
        $this->idParentAsIdResourceRequestModifierQuery =       $idParentAsIdResourceRequestModifierQuery;
        $this->slugRequestModifierQuery =                       $slugRequestModifierQuery;
        $this->leftJoinsManagerService =                        $leftJoinsManagerService;
        $this->cacheManager =                                   $cacheManager;
    }

    /**
     * @return SlugRequestModifierQuery
     */
    public function getSlugRequestModifierQuery(): SlugRequestModifierQuery
    {
        return $this->slugRequestModifierQuery;
    }

    /**
     * @return IdResourceRequestModifierQuery
     */
    public function getIdResourceRequestModifierQuery(): IdResourceRequestModifierQuery
    {
        return $this->idResourceRequestModifierQuery;
    }

    /**
     * @return IdParentRequestModifierQuery
     */
    public function getIdParentRequestModifierQuery(): IdParentRequestModifierQuery
    {
        return $this->idParentRequestModifierQuery;
    }

    /**
     * @return CacheManager
     */
    public function getCacheManager(): CacheManager
    {
        return $this->cacheManager;
    }

    /**
     * @return IdParentAsIdResourceRequestModifierQuery
     */
    public function getIdParentAsIdResourceRequestModifierQuery(): IdParentAsIdResourceRequestModifierQuery
    {
        return $this->idParentAsIdResourceRequestModifierQuery;
    }

    /**
     * @return PaginationRequestModifierQuery
     */
    public function getPaginationRequestModifierQuery(): PaginationRequestModifierQuery
    {
        return $this->paginationRequestModifierQuery;
    }

    /**
     * @return OrderingRequestModifierQuery
     */
    public function getOrderingRequestModifierQuery(): OrderingRequestModifierQuery
    {
        return $this->orderingRequestModifierQuery;
    }

    /**
     * @return ShopsLetterRequestModifierQuery
     */
    public function getShopsLetterRequestModifierQuery(): ShopsLetterRequestModifierQuery
    {
        return $this->shopsLetterRequestModifierQuery;
    }

    /**
     * @return LeftJoinsManagerService
     */
    public function getLeftJoinsModifierQuery(): LeftJoinsManagerService
    {
        return $this->leftJoinsManagerService;
}
}
