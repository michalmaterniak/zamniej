<?php
namespace App\Controller\Front\Api\Shops;

use App\Application\Pages\Page\Page;
use App\Application\Pages\Page\Types\Shops\Services\CheckerLetter;
use App\Application\Pages\Page\Types\Shops\Shops;
use App\Controller\Front\Api\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ShopsController extends AbstractController
{
    /**
     * @param Shops $page
     * @param CheckerLetter $checerkLetter
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function shops(Shops $page, CheckerLetter $checerkLetter)
    {
        if ($checerkLetter->letterExist() && !$checerkLetter->checkLetter()) {
            throw new NotFoundHttpException();
        } else {
            $this->templateVars->insert('page', $this->normalizer->normalize($page, null, [
                'groups' => ['resource', 'seo', 'subpage'],
            ]));

            return $this->responseJson();
        }
    }

    /**
     * @param Page $page
     * @param CheckerLetter $checerkLetter
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function index(Page $page, CheckerLetter $checerkLetter)
    {
        if ($checerkLetter->letterExist() && !$checerkLetter->checkLetter()) {
            throw new NotFoundHttpException();
        }
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
