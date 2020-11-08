<?php
namespace App\Application\Pages\Page\Types\Blog\Article;

use App\Application\Pages\Page\Page;

/**
 * Class BlogArticle
 * @package App\Application\Pages\Page\Types\Blog\Article
 * @method BlogArticleSubpage getSubpage(string $locale = null)
 */
class BlogArticle extends Page
{
    public function __construct(
        BlogArticleSubpagesManager $resourceSubpagesManager,
        BlogArticleComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
