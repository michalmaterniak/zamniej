<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Offers\Factory\Offers\Promotion\OfferCustomPromotionFactory;
use App\Application\Offers\Factory\Offers\Voucher\OfferCustomVoucherFactory;
use App\Application\Offers\Factory\Offers\Voucher\OfferEntityVoucherFactory;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersVouchersRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VouchersController extends AbstractController
{
    /**
     * @var WebepartnersVouchersRepository $webepartnersVouchersRepository
     */
    protected $webepartnersVouchersRepository;

    /**
     * @param WebepartnersVouchersRepository $webepartnersVouchersRepository
     * @required
     */
    public function setWebepartnersVouchersRepository(WebepartnersVouchersRepository $webepartnersVouchersRepository): void
    {
        $this->webepartnersVouchersRepository = $webepartnersVouchersRepository;
    }

    /**
     * @param WebepartnersPrograms $idShop
     * @Route("/admin/api/affiliations/webepartners/vouchers/{idShop}", name="admin-api-affiliations-webepartners-vouchers", requirements={"idShop"="\d+"}, methods={"POST"})
     */
    public function getVouchers(WebepartnersPrograms $idShop)
    {
        $banners = $this->webepartnersVouchersRepository->select()->findAllActiveByShop($idShop)->getResults();

        return $this->json([
            'count' => $banners->count(),
            'vouchers' => $this->normalizer->normalize($banners, null, ['groups' => ['resource-admin-listing', 'offers-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }

    /**
     * @param RequestPostContentData $requestPostContentData
     * @param OfferEntityVoucherFactory $offerVoucherFactory
     * @return JsonResponse
     * @Route("/admin/api/affiliations/webepartners/vouchers/createOffer", name="admin-api-affiliations-webepartners-vouchers-createOffer", methods={"POST"})
     */
    public function createOffer(RequestPostContentData $requestPostContentData, OfferEntityVoucherFactory $offerVoucherFactory)
    {
        $vouchers = $this->webepartnersVouchersRepository->findAllByIdsOfferIsNull($requestPostContentData->getValue('vouchers', []));
        $count = 0;
        foreach ($vouchers as $voucher) {
            $count++;
            $offerVoucherFactory->createByEntity($voucher);
        }

        return $this->json([
            'message' => 'Utworzono ' . $count . ' ofert',
        ]);
    }

    /**
     * @param RequestPostContentData $requestPostContentData
     * @param OfferCustomVoucherFactory $offerVoucherFactory
     * @param OfferCustomPromotionFactory $offerPromotionFactory
     * @return JsonResponse
     * @Route("/admin/api/affiliations/webepartners/vouchers/createCustomOffer", name="admin-api-affiliations-webepartners-vouchers-createCustomOffer", methods={"POST"})
     */
    public function createCustomOffer(
        RequestPostContentData $requestPostContentData,
        OfferCustomVoucherFactory $offerVoucherFactory,
        OfferCustomPromotionFactory $offerPromotionFactory
    )
    {
        $offer = $requestPostContentData->getValue('offer');
        $offerFactory = (isset($offer['code']) && $offer['code']) ? $offerVoucherFactory : $offerPromotionFactory;
        $offerFactory->create($offer);

        return $this->json([
            'success' => true,
            'message' => 'Utworzono nową ofertę',
        ]);
    }
}
