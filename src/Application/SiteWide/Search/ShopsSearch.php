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
     * @var string $text
     */
    protected $text;

    public function __construct(
        ShopRepository $shopsRepository,
        PagesManager $modelPagesManager,
        RequestPostContentData $requestPostContentData
    )
    {
        $this->shopsRepository = $shopsRepository;
        $this->modelPagesManager = $modelPagesManager;
        $this->text = $requestPostContentData->getValue('shop', '');
    }

    public function getShops()
    {
        $shops = new ArrayCollection();
        if (strlen($this->text) < 3) {
            return $shops;
        }

        foreach ($this->modelPagesManager->loadShops(
            $this->shopsRepository->select()->findByText($this->text)->getResults()
        ) as $shop) {
            $shops->add([
                'name' => $shop->getSubpage()->getSubpage()->getName(),
                'logo' => $shop->getSubpage()->getPhoto()->getModifiedPhoto('insertCenter', 262, 116, ['background' => '#ffffff', 'margin-horizontal' => 40, 'margin-vertical' => 20]),
                'slug' => $shop->getSubpage()->getSlug()
            ]);
        }
        return $shops;
    }
}
