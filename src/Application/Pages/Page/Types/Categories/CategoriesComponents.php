<?php
namespace App\Application\Pages\Page\Types\Categories;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\PageComponents;
use App\Application\Pages\Page\Types\Categories\Factory\CategoriesFactory;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;
use App\Repository\Repositories\Subpages\Pages\Types\CategoriesRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class CategoriesComponents
 * @package App\Application\Pages\Page\Types\Categories
 */
class CategoriesComponents extends PageComponents
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoriesRepository $categoriesRepository,
        CategoriesConfig $resourceConfig,
        CategoriesFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    )
    {
        parent::__construct($categoriesRepository, $resourceConfig, $resourceFactory, $offersManager, $slide, $photo, $router);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryRepository
     */
    public function getCategoryRepository(): CategoryRepository
    {
        return $this->categoryRepository;
    }
}
