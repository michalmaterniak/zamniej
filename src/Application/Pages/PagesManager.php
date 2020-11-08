<?php
namespace App\Application\Pages;

use App\Application\Pages\Category\Category;
use App\Application\Pages\Homepage\Homepage;
use App\Application\Pages\Page\Types\Blog\Article\BlogArticle;
use App\Application\Pages\Page\Types\Blog\Articles\BlogArticles;
use App\Application\Pages\Page\Types\Categories\Categories;
use App\Application\Pages\Page\Types\Promotions\Promotions;
use App\Application\Pages\Page\Types\Shops\Shops;
use App\Application\Pages\Shop\Shop;
use App\Entity\Entities\Subpages\Resources;
use App\Entity\Interfaces\ResourcesInterface;
use App\Services\Pages\ResourcesManager;
use Doctrine\Common\Collections\ArrayCollection;

class PagesManager extends ResourcesManager
{
    public function __construct(
        Homepage        $homepage,
        Promotions      $promotions,
        Shops           $shops,
        Categories      $categories,
        BlogArticles    $blogArticles,
        BlogArticle     $blogArticle,
        Category        $category,
        Shop            $shop
    )
    {
        parent::__construct();
        $this->register($homepage);
        $this->register($promotions);
        $this->register($shops);
        $this->register($categories);
        $this->register($blogArticles);
        $this->register($blogArticle);
        $this->register($category);
        $this->register($shop);
    }


    /**
     * @param Resources|ResourcesInterface $resource
     * @param bool $isResource
     * @return Shop|Resource|null
     */
    public function loadShop($resource, bool $isResource = false): ?Shop
    {
        if ($isResource)
            return $this->loadResource($resource);
        else
            return $this->loadEntity($resource);
    }


    /**
     * @param \App\Entity\Entities\Categories\Categories[]|Resources[]|ResourcesInterface[] $resources
     * @param bool $isResource
     * @return Category[]|Resource[]|ArrayCollection
     */
    public function loadCategories($resources, bool $isResource = false)
    {
        if ($isResource)
            return $this->loadResources($resources);
        else
            return $this->loadEntities($resources);
    }

    /**
     * @param Resources[]|ResourcesInterface[] $resources
     * @param bool $isResource
     * @return Shop[]|Resource[]|ArrayCollection
     */
    public function loadShops($resources, bool $isResource = false)
    {
        if ($isResource)
            return $this->loadResources($resources);
        else
            return $this->loadEntities($resources);
    }

    /**
     * @param Resources[]|ResourcesInterface[] $resources
     * @param bool $isResource
     * @return BlogArticle[]|Resource[]|ArrayCollection
     */
    public function loadBlogArticles($resources, bool $isResource = false)
    {
        if ($isResource)
            return $this->loadResources($resources);
        else
            return $this->loadEntities($resources);
    }
}
