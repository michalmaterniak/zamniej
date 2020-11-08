<?php
namespace App\Controller\Front\Page\Pages\Blog;

use App\Application\Pages\Page\Page;
use App\Controller\Front\Page\AbstractController;

class ArticlesController extends AbstractController
{
    public function index(Page $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/blog/articles.html.twig');
    }
}
