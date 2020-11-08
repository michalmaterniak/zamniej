<?php
namespace App\Controller\Front\Page\Shops;

use App\Application\Pages\Page\Page;
use App\Controller\Front\Page\AbstractController;

class ShopsController extends AbstractController
{
    public function index(Page $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/shops/shops.html.twig');
    }
}
