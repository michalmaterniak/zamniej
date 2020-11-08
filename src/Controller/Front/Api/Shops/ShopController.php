<?php
namespace App\Controller\Front\Api\Shops;

use App\Application\Pages\Shop\Shop;
use App\Controller\Front\Api\AbstractController;

class ShopController extends AbstractController
{
    public function index(Shop $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
