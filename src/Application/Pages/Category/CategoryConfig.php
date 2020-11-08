<?php
namespace App\Application\Pages\Category;

use App\Entity\Entities\Categories\Categories;
use App\Services\Pages\Resource\ResourceConfig;

class CategoryConfig extends ResourceConfig
{
    /**
     * @var int
     */
    protected $key = 6;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Category::class;

    /**
     * @var int|null $child
     */
    protected $child = 7; // shop

    /**
     * @var array|int[]
     */
    protected $availableTypesChildren = [7];

    /**
     * @var string $controller
     */
    protected $controller = 'Categories\\Category';

    /**
     * @var string $entityClass
     */
    protected $entityClass = Categories::class;

    /**
     * @var string
     */
    protected $name = "Kategoria";
}
