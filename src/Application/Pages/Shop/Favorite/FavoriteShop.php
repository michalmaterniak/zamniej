<?php

namespace App\Application\Pages\Shop\Favorite;

use App\Application\Pages\PagesManager;
use App\Application\SiteWide\Search\SearchAdapter;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\System\Request\Retrievers\RequestDataManager;

class FavoriteShop
{
    /**
     * @var ShopRepository $shopsRepository
     */
    protected $shopsRepository;

    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    /**
     * @var SearchAdapter $searchAdapter
     */
    protected $searchAdapter;

    /**
     * @var int $text
     */
    protected $idSubpage;

    public function __construct(
        ShopRepository $shopsRepository,
        PagesManager $modelPagesManager,
        RequestDataManager $requestDataManager,
        SearchAdapter $searchAdapter
    )
    {
        $this->shopsRepository = $shopsRepository;
        $this->modelPagesManager = $modelPagesManager;
        $this->searchAdapter = $searchAdapter;
        $this->idSubpage = $requestDataManager->getValue('idSubpage', '');
    }

    public function getShop()
    {
        $shop = $this->modelPagesManager->loadShop(
            $this->shopsRepository->select()->findByIdSubpage($this->idSubpage)->getResultOrNull()
        );

        return $shop ? $this->searchAdapter->getSearchShop($shop) : null;
    }
}
