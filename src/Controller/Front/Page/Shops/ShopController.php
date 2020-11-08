<?php
namespace App\Controller\Front\Page\Shops;

use App\Application\Pages\Shop\Shop;
use App\Controller\Front\Page\AbstractController;

class ShopController extends AbstractController
{
    public function index(Shop $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/shops/shop.html.twig');
    }
}
