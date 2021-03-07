<?php
namespace App\Controller\Front\Api\Shops;

use App\Application\Pages\Shop\Favorite\FavoriteShop;
use App\Application\Pages\Shop\Shop;
use App\Controller\Front\Api\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    public function index(Shop $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }

    /**
     * @param FavoriteShop $favoriteShop
     * @return JsonResponse
     * @Route("/page/api/shop/favorite/{idSubpage}", name="page-api-shop-favorite", methods={"POST"})
     */
    public function favorite(FavoriteShop $favoriteShop)
    {
        $this->templateVars->insert('shop', $this->normalizer->normalize($favoriteShop->getShop(), null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
