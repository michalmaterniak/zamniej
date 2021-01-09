<?php
namespace App\Controller\Front\Api;

use App\Application\Pages\PagesManager;
use App\Controller\Front\Api\AbstractController as GlobalController;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Twig\TemplateVars;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MainController extends GlobalController
{
    /**
     * @var TemplateVars $templateVars
     */
    protected $templateVars;

    /**
     * @var NormalizerInterface $normalizer
     */
    protected $normalizer;

    /**
     * @param PagesManager $modelPagesManager
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse|Response
     * @throws ErrorException
     * @throws ExceptionInterface
     * @Route("/page/api/main", name="page-api-main", methods={"POST"})
     */
    public function main(PagesManager $modelPagesManager, RequestPostContentData $requestPostContentData)
    {
        $page = $modelPagesManager->getCurrentResourceModel(true);
        if (!$page || !$page->getSubpage()->getSubpage()->isActive()) {
            return $this->forward("App\Controller\Front\Api\ErrorsController" . '::error404', [
            ]);
        }

        $className = 'App\\Controller\\Front\\Api\\' . $page->getComponents()->getResourceConfig()->getController() . 'Controller';

        $method = $requestPostContentData->getValue('method', 'index');

        if (method_exists($className, $method)) {
            return $this->forward($className . '::' . $method, [
                'page' => $page,
            ]);
        } else {
            $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
                'groups' => ['resource', 'seo', 'subpage'],
            ]));

            return $this->responseJson();
        }
    }
}
