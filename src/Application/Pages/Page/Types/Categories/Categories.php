<?php
namespace App\Application\Pages\Page\Types\Categories;

use App\Application\Pages\Page\Page;

/**
 * Class Categories
 * @package App\Application\Pages\Page\Types\Categories
 * @method CategoriesSubpage getSubpage(string $locale = null) : ResourceSubpage
 */
class Categories extends Page
{
    public function __construct(
        CategoriesSubpagesManager $resourceSubpagesManager,
        CategoriesComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
