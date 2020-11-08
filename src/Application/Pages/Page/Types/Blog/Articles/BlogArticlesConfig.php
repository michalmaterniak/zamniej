<?php
namespace App\Application\Pages\Page\Types\Blog\Articles;

use App\Application\Pages\Page\PageConfig;

/**
 * Class BlogArticlesConfig
 * @package App\Application\Pages\Page\Types\Blog\Articles
 */
class BlogArticlesConfig extends PageConfig
{
    /**
     * @var int $key
     */
    protected $key = 4;

    /**
     * @var string $modelClass
     */
    protected $modelClass = BlogArticles::class;

    /**
     * @var int $child
     */
    protected $child = 5;

    /**
     * @var int[]|array
     */
    protected $availableTypesChildren = [5];

    /**
     * @var string $controller
     */
    protected $controller = "Pages\\Blog\\Articles";

    /**
     * @var string
     */
    protected $name = "Artykuły blogowe";
}
