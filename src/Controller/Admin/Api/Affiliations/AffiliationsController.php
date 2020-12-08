<?php

namespace App\Controller\Admin\Api\Affiliations;

use App\Controller\Admin\Api\AbstractController;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AffiliationsController extends AbstractController
{
    /**
     * @param AffiliationsRepository $affiliationsRepository
     * @return JsonResponse
     * @Route("/admin/api/affiliations/affiliations-listing", name="admin-api-affiliations-affiliations-listing", methods={"POST"})
     */
    public function affiliations(AffiliationsRepository $affiliationsRepository)
    {
        $affiliations = $affiliationsRepository->select(false)->getResults();
        $this->templateVars->insert('affiliations', $this->normalizer->normalize($affiliations, null, [
            'groups' => ['resource-admin']
        ]));

        return $this->responseJson();
    }
}
