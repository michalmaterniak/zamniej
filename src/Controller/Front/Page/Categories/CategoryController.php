<?php
namespace App\Controller\Front\Page\Categories;

use App\Application\Pages\Category\Category;
use App\Controller\Front\Page\AbstractController;

class CategoryController extends AbstractController
{
    public function index(Category $page)
    {
        $this->twigArray->insert('page', $page);


        return $this->renderTwig('page/categories/category.html.twig');
    }
}
