<?php
namespace App\Application\SiteWide\Links;

use App\Application\LinkingInternal\GSCIndexes\GSCIndexesLinking;
use App\Application\Pages\PagesManager;
use App\Application\SiteWide\FrontInitInterface;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;

class FooterLinks implements FrontInitInterface
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * @var ShopRepository $shopRepository
     */
    protected $shopRepository;

    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

    /**
     * @var GSCIndexesLinking $gscIndexesLinking
     */
    protected GSCIndexesLinking $gscIndexesLinking;

    public function __construct(
        PagesManager $pagesManager,
        CategoryRepository $categoryRepository,
        ShopRepository $shopRepository,
        GSCIndexesLinking $gscIndexesLinking
    )
    {
        $this->pagesManager = $pagesManager;
        $this->categoryRepository = $categoryRepository;
        $this->shopRepository = $shopRepository;
        $this->gscIndexesLinking = $gscIndexesLinking;
    }

    protected function getCategories()
    {
        $categories = new ArrayCollection();
        foreach ($this->pagesManager->loadCategories(
            $this->categoryRepository->select()->footerLinks()->getResults()
        ) as $category) {
            $categories->add(
                [
                    'name' => $category->getSubpage()->getSubpage()->getName(),
                    'link' => $category->getSubpage()->getSlug()
                ]
            );
        }

        $categories->add(
            [
                'name' => '<strong>Zobacz więcej</strong>',
                'link' => '/kategorie',
            ]
        );

        return $categories;
    }

    protected function getLatestShops(int $maxCount = 8): array
    {
        $shops = [];
        foreach ($this->pagesManager->loadShops(
            $this->shopRepository->select()->getLatest($maxCount)->getResults()
        ) as $shop) {
            $shops[] = [
                'name' => $shop->getSubpage()->getSubpage()->getName(),
                'link' => $shop->getSubpage()->getSlug()
            ];
        }

        return $shops;
    }

    public function getValue(): array
    {
        return [
            'info' => [
                'group' => 'Najnowsze sklepy',
                'links' => $this->getLatestShops(),
            ],
            'shops' => [
                'group' => 'Popularne Sklepy',
                'links' => [
                    [
                        'name' => 'TaniaKsiazka',
                        'link' => '/sklepy/taniaksiazka-pl',
                    ],
                    [
                        'name' => 'Mr. Whitening',
                        'link' => '/sklepy/mr-whitening',
                    ],
                    [
                        'name' => 'Piękno w Domu',
                        'link' => '/sklepy/piekno-w-domu',
                    ],
                    [
                        'name' => 'ButyRaj',
                        'link' => '/sklepy/butyraj',
                    ],
                    [
                        'name' => '4KOM',
                        'link' => '/sklepy/4kom',
                    ],
                    [
                        'name' => 'Złoty sklep FABER-CASTELL',
                        'link' => '/sklepy/zloty-sklep-faber-castell',
                    ],
                    [
                        'name' => 'Rafjolka',
                        'link' => '/sklepy/rafjolka',
                    ],
                ],
            ],
            'other_shops' => [
                'group' => 'Inne sklepy',
                'links' => $this->getGSCIndexesLinks(),
            ],
            'categories' => [
                'group' => 'Kategorie',
                'links' => $this->getCategories(),
            ],
        ];
    }

    public function getName(): string
    {
        return 'footer';
    }

    public function getGSCIndexesLinks()
    {
        $links = new ArrayCollection();

        $models = $this->pagesManager->loadEntities(
            $this->gscIndexesLinking->getLastGSCIndexesResources()
        );

        foreach ($models as $resource) {
            $links->add([
                'name' => $resource->getSubpage()->getSubpage()->getName(),
                'link' => $resource->getSubpage()->getSlug()
            ]);
        }

        return $links;
    }
}
