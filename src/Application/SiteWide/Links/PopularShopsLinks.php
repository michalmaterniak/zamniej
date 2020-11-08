<?php
namespace App\Application\SiteWide\Links;

use App\Application\Pages\PagesManager;
use App\Application\SiteWide\FrontInitInterface;
use App\Repository\Repositories\Shops\ShopsRepository;


class PopularShopsLinks implements FrontInitInterface
{
    private static $keySettings = 'Popular-Shops';

    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    /**
     * @var ShopsRepository $shopsRepository
     */
    protected $shopsRepository;

    public function __construct(
        ShopsRepository $shopsRepository,
        PagesManager $modelPagesManager
    ) {
        $this->modelPagesManager = $modelPagesManager;
        $this->shopsRepository = $shopsRepository;
    }

    public function getName(): string
    {
        return 'popularShops';
    }

    public function getValue()
    {
        $shops = $this->modelPagesManager->loadShops(
            $this->shopsRepository->select()->lastPopular()->getResults(), true
        );

        $linksTag = [];
        foreach ($shops as $shop) {

            $linksTag[] = [
                'anchor' => $shop->getSubpage()->getTag(),
                'slug' => $shop->getSubpage()->getSlug(),
            ];
        }
        return $linksTag;
    }
}
