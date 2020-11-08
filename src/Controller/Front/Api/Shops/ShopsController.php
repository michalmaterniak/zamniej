<?php
namespace App\Controller\Front\Api\Shops;

use App\Application\Pages\Page\Page;
use App\Application\Pages\Page\Types\Shops\Shops;
use App\Controller\Front\Api\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ShopsController extends AbstractController
{
    /**
     * @param Shops $page
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function shops(Shops $page)
    {
        $shops = $page->getSubpage()->getShops();
        $this->templateVars->insert('shops', $this->normalizer->normalize($shops, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }

    public function index(Page $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
