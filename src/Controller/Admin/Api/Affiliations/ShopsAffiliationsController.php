<?php

namespace App\Controller\Admin\Api\Affiliations;

use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShopsAffiliationsController extends AbstractController
{
    /**
     * @param ShopsAffiliationRepository $shopsAffiliationRepository
     * @return JsonResponse
     * @Route("/admin/api/affiliations/shopaffiliations-subpage/{subpage}", name="admin-api-affiliations-shopaffiliations-subpage", methods={"POST"})
     */
    public function affiliations(Subpages $subpage, ShopsAffiliationRepository $shopsAffiliationRepository)
    {
        $affiliations = $shopsAffiliationRepository->select()->findBySubpage($subpage)->getResults();
        $this->templateVars->insert('affiliations', $this->normalizer->normalize($affiliations, null, [
            'groups' => ['resource-admin']
        ]));

        return $this->responseJson();
    }
}
