<?php
namespace App\Application\SiteWide\Links;

use App\Application\Pages\Page\Types\Categories\CategoriesComponents;
use App\Application\Pages\PagesManager;
use App\Application\SiteWide\FrontInitInterface;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;

class FooterLinks implements FrontInitInterface
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

    public function __construct(CategoriesComponents $categoryComponents)
    {
        $this->categoryRepository = $categoryComponents->getCategoryRepository();
        $this->pagesManager = $categoryComponents->getResourcesManager();
    }

    protected function getCategories()
    {
        $categories = [];
        foreach ($this->pagesManager->loadCategories(
            $this->categoryRepository->select()->footerLinks()->getResults()
        ) as $category) {
            $categories[] = [
                'name' => $category->getSubpage()->getSubpage()->getName(),
                'link' => $category->getSubpage()->getSlug()
            ];
        }
        return $categories;
    }

    public function getValue(): array
    {
        return [
            'info' => [
                'group' => 'Informacje',
                'links' => [
                ],
            ],
            'shops' => [
                'group' => 'Sklepy',
                'links' => [
                    [
                        'name' => 'Elektronicon',
                        'link' => '/sklepy/elektronicon',
                    ],
                    [
                        'name' => 'TermoKubki',
                        'link' => '/sklepy/termokubki',
                    ],
                    [
                        'name' => 'Biżuteria i zegarki',
                        'link' => '/sklepy/bizuteria-zegarki-pl',
                    ],
                    [
                        'name' => 'OutletRTVAGD',
                        'link' => '/sklepy/outletrtvagd-pl',
                    ],
                    [
                        'name' => 'wec.com.pl',
                        'link' => '/sklepy/wec-com-pl',
                    ],
                    [
                        'name' => 'Złoty sklep FABER-CASTELL',
                        'link' => '/sklepy/zloty-sklep-faber-castell',
                    ],
                    [
                        'name' => 'DrTusz',
                        'link' => '/sklepy/drtusz',
                    ],
                ],
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
}
