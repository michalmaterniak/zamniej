<?php
namespace App\Application\Pages\Page\Types\Blog\Articles;

use App\Application\Pages\Page\Page;

/**
 * Class BlogArticles
 * @package App\Application\Pages\Page\Types\Blog\Articles
 * @method BlogArticlesSubpage getSubpage(string $locale = null) : ResourceSubpage
 */
class BlogArticles extends Page
{
    public function __construct(
        BlogArticlesSubpagesManager $resourceSubpagesManager,
        BlogArticlesComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
