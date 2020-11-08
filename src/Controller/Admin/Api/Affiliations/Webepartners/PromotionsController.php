<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Offers\Factory\Offers\OfferPromotionFactory;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersPromotionsRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\Routing\Annotation\Route;

class PromotionsController extends AbstractController
{
    /**
     * @var WebepartnersPromotionsRepository $webepartnersPromotionsRepository
     */
    protected $webepartnersPromotionsRepository;

    /**
     * @param WebepartnersPromotionsRepository $webepartnersPromotionsRepository
     * @required
     */
    public function setWebepartnersPromotionsRepository(WebepartnersPromotionsRepository $webepartnersPromotionsRepository): void
    {
        $this->webepartnersPromotionsRepository = $webepartnersPromotionsRepository;
    }

    /**
     * @param WebepartnersPrograms $idShop
     * @Route("/admin/api/affiliations/webepartners/promotions/{idShop}", name="admin-api-affiliations-webepartners-promotions", requirements={"idShop"="\d+"}, methods={"POST"})
     */
    public function getPromotions(WebepartnersPrograms $idShop)
    {
        $promotions = $this->webepartnersPromotionsRepository->select()->findAllActiveByShop($idShop)->getResults();

        return $this->json([
            'count' => $promotions->count(),
            'promotions' => $this->normalizer->normalize($promotions, null, ['groups' => ['resource-admin-listing', 'offers-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }
    /**
     * @param RequestPostContentData $requestPostContentData
     * @Route("/admin/api/affiliations/webepartners/promotions/createOffer", name="admin-api-affiliations-webepartners-promotions-createOffer", methods={"POST"})
     */
    public function createOffer(RequestPostContentData $requestPostContentData, OfferPromotionFactory $offerPromotionFactory)
    {
        $promotions = $this->webepartnersPromotionsRepository->findAllByIdsOfferIsNull($requestPostContentData->getValue('promotions', []));
        $count = 0;
        foreach ($promotions as $promotion) {
            $count++;
            $offerPromotionFactory->create($promotion);
        }

        return $this->json([
            'message' => 'Utworzono '.$count.' ofert',
        ]);
    }
}
