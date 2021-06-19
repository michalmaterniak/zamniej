<?php
namespace App\Application\SiteWide\Search;

use App\Application\Pages\PagesManager;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\Common\Collections\ArrayCollection;

class ShopsSearch
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
     * @var string $text
     */
    protected $text;

    public function __construct(
        ShopRepository $shopsRepository,
        PagesManager $modelPagesManager,
        RequestPostContentData $requestPostContentData,
        SearchAdapter $searchAdapter
    )
    {
        $this->shopsRepository = $shopsRepository;
        $this->modelPagesManager = $modelPagesManager;
        $this->searchAdapter = $searchAdapter;
        $this->text = $requestPostContentData->getValue('shop', '');
    }

    public function getShops()
    {
        $shops = new ArrayCollection();
        if (strlen($this->text) < 3) {
            return $shops;
        }

        return $this->searchAdapter->getSearchShops(
            $this->modelPagesManager->loadShops(
                $this->shopsRepository->select()->findSearched($this->text)->getResults()
            )
        );
    }
}
