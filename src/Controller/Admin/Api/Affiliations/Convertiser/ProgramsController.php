<?php

namespace App\Controller\Admin\Api\Affiliations\Convertiser;

use App\Application\Affiliations\Convertiser\Urls\UrlToTrackingConverterConvertiser;
use App\Controller\Admin\Api\AbstractController;
use App\Repository\Repositories\Affiliations\Convertiser\ConvertiserProgramsRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Twig\TemplateVars;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProgramsController extends AbstractController
{
    /**
     * @var ConvertiserProgramsRepository $convertiserProgramsRepository
     */
    protected $convertiserProgramsRepository;

    public function __construct(ConvertiserProgramsRepository $convertiserProgramsRepository, NormalizerInterface $normalizer, TemplateVars $templateVars)
    {
        parent::__construct($normalizer, $templateVars);
        $this->convertiserProgramsRepository = $convertiserProgramsRepository;
    }

    /**
     * @param UrlToTrackingConverterConvertiser $trackingConverterConvertiser
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse
     * @Route("/admin/api/affiliations/convertiser/programs-convertUrl", name="admin-api-affiliations-convertiser-programs-convertUrl", methods={"POST"})
     */
    public function convertUrl(UrlToTrackingConverterConvertiser $trackingConverterConvertiser, RequestPostContentData $requestPostContentData)
    {
        if ($url = $trackingConverterConvertiser->getUrl($requestPostContentData->getValue('url', false))) {
            return $this->responseJson(
                [
                    'success' => true,
                    'tracking-url-convertiser' => $url
                ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'nie znaleziono adresu'
            ]);
        }
    }

    /**
     * @Route("/admin/api/affiliations/convertiser/programs-new", name="admin-api-affiliations-convertiser-convertiser-programs-new", methods={"POST"})
     */
    public function new()
    {
        $programs = $this->convertiserProgramsRepository->select()->getNewPrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => ['program-admin-list']]),
        ], 200);
    }


    /**
     * @Route("/admin/api/affiliations/convertiser/programs-active", name="admin-api-affiliations-convertiser-programs-active", methods={"POST"})
     */
    public function active()
    {
        $programs = $this->convertiserProgramsRepository->select()->getActivePrograms()->withSubpageAndResource()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/convertiser/programs-unactive", name="admin-api-affiliations-convertiser-programs-unactive", methods={"POST"})
     */
    public function unactive()
    {
        $programs = $this->convertiserProgramsRepository->select()->getUnactivePrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/convertiser/programs-program/{id}", name="admin-api-affiliations-convertiser-programs-program", methods={"POST"})
     */
    public function program($id)
    {
        $program = $this->convertiserProgramsRepository->select()->getProgramById($id)->withSubpageAndResource()->getResultOrNull();
        return $this->json([
            'program' => $this->normalizer->normalize($program, null, ['groups' => 'program-admin']),
        ], 200);
    }
}
