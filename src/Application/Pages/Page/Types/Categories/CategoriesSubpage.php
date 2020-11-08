<?php
namespace App\Application\Pages\Page\Types\Categories;

use App\Application\Pages\Category\Category;
use App\Application\Pages\Page\PageSubpage;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class CategoriesSubpage
 * @package App\Application\Pages\Page\Types\Categories
 * @method CategoriesComponents getComponents() : ResourceComponents
 */
class CategoriesSubpage extends PageSubpage
{
    /**
     * @var Category[]|ArrayCollection
     */
    protected $categories;

    public function __construct(CategoriesComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return Category[]|ArrayCollection
     */
    public function getCategories()
    {
        if (!$this->categories) {
            $this->categories = $this->getComponents()->getResourcesManager()->loadCategories(
                $this->getComponents()->getCategoryRepository()->select()->listingCategories()->getResults()
            );
        }

        return $this->categories;
    }

    /**
     * @return array
     * @Groups({"resource"})
     */
    public function getCategoriesTiles()
    {
        $categoriesTiles = [];
        foreach ($this->getCategories() as $category) {
            $categoriesTiles[] = [
                'logo' => $category->getLogo()->getModifiedPhoto('fit', 370, 245),
                'name' => $category->getSubpage()->getSubpage()->getName(),
                'slug' => $category->getSubpage()->getSlug(),
                'count' => $category->getModelEntity()->getCountChildren()
            ];
        }
        return $categoriesTiles;
    }
}
