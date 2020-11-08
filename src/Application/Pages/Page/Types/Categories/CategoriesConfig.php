<?php
namespace App\Application\Pages\Page\Types\Categories;

use App\Application\Pages\Page\PageConfig;

/**
 * Class CategoriesConfig
 * @package App\Application\Pages\Page\Types\Categories
 */
class CategoriesConfig extends PageConfig
{
    /**
     * @var int $key
     */
    protected $key = 3;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Categories::class;

    /**
     * @var int $child
     */
    protected $child = 6;

    /**
     * @var int[]|array $availableTypesChildren
     */
    protected $availableTypesChildren = [6];

    /**
     * @var string $controller
     */
    protected $controller = "Categories\\Categories";

    /**
     * @var string
     */
    protected $name = "Strona z kategoriami";
}
