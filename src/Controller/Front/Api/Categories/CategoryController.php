<?php
namespace App\Controller\Front\Api\Categories;

use App\Application\Pages\Category\Category;
use App\Controller\Front\Api\AbstractController;

class CategoryController extends AbstractController
{
    public function index(Category $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
