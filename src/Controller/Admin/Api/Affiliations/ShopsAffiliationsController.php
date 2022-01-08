<?php

namespace App\Controller\Admin\Api\Affiliations;

use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
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
        $affiliations = $shopsAffiliationRepository->select()->findBySubpage($subpage)->withAffiliaiton()->getResults();
        $this->templateVars->insert('affiliations', $this->normalizer->normalize($affiliations, null, [
            'groups' => ['resource-admin']
        ]));

        return $this->responseJson();
    }

    /**
     * @param ShopsAffiliation $shopAffiliation
     * @param ShopsAffiliationRepository $shopsAffiliationRepository
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse
     * @Route("/admin/api/affiliations/shopaffiliations-save/{shopAffiliation}", name="admin-api-affiliations-shopaffiliations-save", methods={"POST"})
     */
    public function save(
        ShopsAffiliation $shopAffiliation,
        ShopsAffiliationRepository $shopsAffiliationRepository,
        RequestPostContentData $requestPostContentData
    ) {
        if (!$requestPostContentData->checkIfExist('affiliation')) {
            return $this->json(['status' => false, 'message' => 'Brak danych afiliacji']);
        }

        $affiliationNewData = $requestPostContentData->getValue('affiliation');
        $shopAffiliation->setLinkForce($affiliationNewData['linkForce']);
        $shopAffiliation->setEnable($affiliationNewData['enable']);
        $shopAffiliation->setForceActive($affiliationNewData['forceActive']);

        if ($affiliationNewData['forceActive']) {
            foreach ($shopsAffiliationRepository->select()->findAllOtherBySubpage($shopAffiliation)->getResults() as $otherShopAffiliation) {
                $otherShopAffiliation->setForceActive(false);
            }
        }

        $this->getDoctrine()->getManager()->flush();
        return $this->json(['status' => true, 'message' => 'Zapisano nowe ustawienia afiliacji']);


    }
}
