<?php
namespace App\Application\Pages\Page\Types\Blog\Article;

use App\Application\Pages\Page\PageConfig;

/**
 * Class BlogArticleConfig
 * @package App\Application\Pages\Page\Types\Blog\Article
 */
class BlogArticleConfig extends PageConfig
{
    /**
     * @var int $key
     */
    protected $key = 5;

    /**
     * @var string $modelClass
     */
    protected $modelClass = BlogArticle::class;

    /**
     * @var null $child
     */
    protected $child = null;

    /**
     * @var string $controller
     */
    protected $controller = "Pages\\Blog\\Article";

    /**
     * @var string
     */
    protected $name = "Artykuł blogowy";
}
