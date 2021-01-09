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
