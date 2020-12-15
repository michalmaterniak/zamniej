<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Offers\Factory\Offers\OfferPromotionFactory;
use App\Application\Offers\Factory\Offers\OfferVoucherFactory;
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
     * @param OfferVoucherFactory $offerVoucherFactory
     * @return JsonResponse
     * @Route("/admin/api/affiliations/webepartners/vouchers/createOffer", name="admin-api-affiliations-webepartners-vouchers-createOffer", methods={"POST"})
     */
    public function createOffer(RequestPostContentData $requestPostContentData, OfferVoucherFactory $offerVoucherFactory)
    {
        $vouchers = $this->webepartnersVouchersRepository->findAllByIdsOfferIsNull($requestPostContentData->getValue('vouchers', []));
        $count = 0;
        foreach ($vouchers as $voucher) {
            $count++;
            $offerVoucherFactory->create($voucher);
        }

        return $this->json([
            'message' => 'Utworzono ' . $count . ' ofert',
        ]);
    }

    /**
     * @param RequestPostContentData $requestPostContentData
     * @param OfferVoucherFactory $offerVoucherFactory
     * @param OfferPromotionFactory $offerPromotionFactory
     * @return JsonResponse
     * @Route("/admin/api/affiliations/webepartners/vouchers/createCustomOffer", name="admin-api-affiliations-webepartners-vouchers-createCustomOffer", methods={"POST"})
     */
    public function createCustomOffer(
        RequestPostContentData $requestPostContentData,
        OfferVoucherFactory $offerVoucherFactory,
        OfferPromotionFactory $offerPromotionFactory
    )
    {
        $code = $requestPostContentData->getValue('');
        $vouchers = $this->webepartnersVouchersRepository->findAllByIdsOfferIsNull($requestPostContentData->getValue('vouchers', []));
        $count = 0;
        foreach ($vouchers as $voucher) {
            $count++;
            $offerVoucherFactory->create($voucher);
        }

        return $this->json([
            'message' => 'Utworzono ' . $count . ' ofert',
        ]);
    }
}
