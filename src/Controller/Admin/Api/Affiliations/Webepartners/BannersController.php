<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Offers\Factory\Offers\Banner\OfferEntityBannerFactory;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersBannersRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class BannersController extends AbstractController
{
    /**
     * @var WebepartnersBannersRepository $webepartnersBannersRepository
     */
    protected $webepartnersBannersRepository;

    /**
     * @param WebepartnersBannersRepository $webepartnersBannersRepository
     * @required
     */
    public function setWebepartnersBannersRepository(WebepartnersBannersRepository $webepartnersBannersRepository): void
    {
        $this->webepartnersBannersRepository = $webepartnersBannersRepository;
    }
    /**
     * @param WebepartnersPrograms $idShop
     * @Route("/admin/api/affiliations/webepartners/banners/{idShop}", name="admin-api-affiliations-webepartners-banners", requirements={"idShop"="\d+"}, methods={"POST"})
     */
    public function getBanners(WebepartnersPrograms $idShop)
    {
        $banners = $this->webepartnersBannersRepository->select()->findAllActiveByShop($idShop)->getPaginate();

        return $this->json([
            'count' => $banners->count(),
            'banners' => $this->normalizer->normalize($banners, null, ['groups' => ['resource-admin-listing', 'offers-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }

    /**
     * @param RequestPostContentData $requestPostContentData
     * @param OfferEntityBannerFactory $offerBannerFactory
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/affiliations/webepartners/banners/createOffer", name="admin-api-affiliations-webepartners-banners-createOffer", methods={"POST"})
     */
    public function createOffer(RequestPostContentData $requestPostContentData, OfferEntityBannerFactory $offerBannerFactory)
    {
        $banners = $this->webepartnersBannersRepository->select()->findAllByIdsOfferIsNull($requestPostContentData->getValue('banners', []))->getResults();

        $count = 0;
        $offersBanner = [];
        foreach ($banners as $banner) {
            $count++;
            $offersBanner[$banner->getIdOffer()] = $offerBannerFactory->create($banner);
        }

        return $this->json([
            'message' => 'Utworzono '.$count.' ofert',
            'banners' => $this->normalizer->normalize($offersBanner, null, [
                'groups' => ['resource-admin'],
            ]),
        ]);
    }
}
