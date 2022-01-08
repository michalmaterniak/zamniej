<?php

namespace App\Controller\Admin\Api\Affiliations\Tradetracker;

use App\Application\Affiliations\Convertiser\Urls\UrlToTrackingConverterConvertiser;
use App\Application\Affiliations\Tradetracker\Urls\UrlToTrackingConverterTradetracker;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerProgramsRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Twig\TemplateVars;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProgramsController extends AbstractController
{
    /**
     * @var TradetrackerProgramsRepository $tradetrackerProgramsRepository
     */
    protected $tradetrackerProgramsRepository;

    public function __construct(TradetrackerProgramsRepository $tradetrackerProgramsRepository, NormalizerInterface $normalizer, TemplateVars $templateVars)
    {
        parent::__construct($normalizer, $templateVars);
        $this->tradetrackerProgramsRepository = $tradetrackerProgramsRepository;
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-new", name="admin-api-affiliations-tradetracker-programs-new", methods={"POST"})
     */
    public function new()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getNewPrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => ['program-admin-list']]),
        ], 200);
    }


    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-active", name="admin-api-affiliations-tradetracker-programs-active", methods={"POST"})
     */
    public function active()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getActivePrograms()->withSubpageAndResource()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-unactive", name="admin-api-affiliations-tradetracker-programs-unactive", methods={"POST"})
     */
    public function unactive()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getUnactivePrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-program/{id}", name="admin-api-affiliations-tradetracker-programs-program", methods={"POST"})
     */
    public function program($id)
    {
        $program = $this->tradetrackerProgramsRepository->select()->getProgramById($id)->withSubpageAndResource()->getResultOrNull();
        return $this->json([
            'program' => $this->normalizer->normalize($program, null, ['groups' => 'program-admin']),
        ], 200);
    }

    /**
     * @param UrlToTrackingConverterTradetracker $trackingConverterConvertiser
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse
     * @Route("/admin/api/affiliations/tradetracker/programs-convertUrl/{shopAffiliation}", name="admin-api-affiliations-tradetracker-programs-convertUrl", methods={"POST"})
     */
    public function convertUrl(ShopsAffiliation $shopAffiliation, UrlToTrackingConverterTradetracker $trackingConverterConvertiser, RequestPostContentData $requestPostContentData)
    {
        $trackingConverterConvertiser->setShopAffiliation($shopAffiliation);

        if ($url = $trackingConverterConvertiser->getUrl($requestPostContentData->getValue('url', ''))) {
            return $this->responseJson(
                [
                    'success' => true,
                    'tracking-url-tradetracker' => $url
                ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'nie znaleziono adresu'
            ]);
        }
    }
}
