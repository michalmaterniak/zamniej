<?php
namespace App\Controller\Front\Api\Shops\Offers;

use App\Application\Offers\OffersManager;
use App\Controller\Front\Api\AbstractController;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class OffersController extends AbstractController
{
    /**
     * @param int $idOffer
     * @param OffersRepository $offersRepository
     * @return JsonResponse
     * @Route("/page/api/shops/offers/offer/{idOffer}", name="page-api-shops-offers-offer", methods={"POST"})
     */
    public function offer(int $idOffer, OffersRepository $offersRepository, OffersManager $offersManager)
    {
        $offer = $offersRepository->select()->getOneOfferById($idOffer)->fullOffer()->withShopAffil()->getResultOrNull();
        if ($offer) {
            $offerModel = $offersManager->createModelOffer($offer) ;
            $this->templateVars->insert('offer', $this->normalizer->normalize($offerModel, null, [
                'groups' => ['resource'],
            ]));

            return $this->responseJson();
        } else {
            return $this->responseJson(404);
        }
    }

    /**
     * @param Offers $offer
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse
     * @throws ErrorException
     * @throws ExceptionInterface
     * @Route("/page/api/shops/offers/liking/{offer}", name="page-api-shops-offers-liking", methods={"POST"})
     */
    public function liking(Offers $offer, RequestPostContentData $requestPostContentData)
    {
        if (!$requestPostContentData->checkIfExist('liking')) {
            throw new ErrorException("błąd serwera");
        } elseif (is_bool($requestPostContentData->getValue('liking'))) {
            $positive = (bool)$requestPostContentData->getValue('liking');
            if ($positive) {
                $offer->getLiking()->addPositive();
            } else {
                $offer->getLiking()->addNegative();
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->json([
                'message'   => 'Dziękujemy za opinie!',
                'liking'    => $this->normalizer->normalize($offer->getLiking(), null, ['groups' => ['resource']]),
            ]);
        }

        return $this->json([
            'message' => 'Błąd serwera',
        ], 500);
    }
}
