<?php
namespace App\Controller\Front\Page\Categories;

use App\Application\Pages\Page\Page;
use App\Application\Pages\Page\Types\CategoriesType;
use App\Controller\Front\Page\AbstractController;

class CategoriesController extends AbstractController
{
    public function index(Page $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/categories/categories.html.twig');
    }
}
