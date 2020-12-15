<?php
namespace App\Controller\Front\Api\Pages\Promotions;

use App\Application\Pages\Page\Types\Promotions\Promotions;
use App\Controller\Front\Api\AbstractController;

class PromotionsController extends AbstractController
{
    public function promotions(Promotions $page)
    {
        $this->templateVars->insert('promotions', $this->normalizer->normalize($page->getSubpage()->getOffers(), null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }


    public function index(Promotions $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
