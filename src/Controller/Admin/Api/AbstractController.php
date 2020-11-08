<?php

namespace App\Controller\Admin\Api;

use App\Twig\TemplateVars;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as GlobalController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AbstractController extends GlobalController
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
     * AbstractController constructor.
     * @param NormalizerInterface $normalizer
     * @param TemplateVars $templateVars
     */
    public function __construct(NormalizerInterface $normalizer, TemplateVars $templateVars)
    {
        $this->normalizer = $normalizer;
        $this->templateVars = $templateVars;
    }
    /**
     * @return JsonResponse
     * @Route("/{slug}", name="page-api-abstract-options", methods={"OPTIONS"}, requirements={"slug"=".+"})
     */
    public function options()
    {
        return new JsonResponse([], 204);
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param array $context
     * @return JsonResponse
     */
    protected function responseJson(array $data = [], int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        foreach ($data as $key => $item) {
            $this->templateVars->insert($key, $item);
        }

        return parent::json($this->templateVars->getVars(), $status, $headers, $context);
    }
}
