<?php
namespace App\Controller\Admin\Api\Offers;

use App\Application\Offers\Offer;
use App\Application\Offers\Remove\RemoveOffer;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\Files;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use ErrorException;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class OffersController extends AbstractController
{

    /**
     * @param Offers $offer
     * @param int $priority
     * @Route("/admin/api/offers/priority/{offer}/{priority}", name="admin-api-offers-priority", methods={"POST"})
     */
    public function priority(Offers $offer, int $priority) {
        $offer->addPriority($priority);
        $this->getDoctrine()->getManager()->flush();
        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin']]),
        ], 200);
    }

    /**
     * @param Offers $offer
     * @param EntityUpdater $entityUpdater
     * @param RequestPostContentData $requestPostContentData
     * @return JsonResponse
     * @throws ErrorException
     * @throws ExceptionInterface
     * @Route("/admin/api/offers/store/{offer}", name="admin-api-offers-store", methods={"POST"})
     */
    public function store(Offers $offer, EntityUpdater $entityUpdater, RequestPostContentData $requestPostContentData)
    {
        if (!$requestPostContentData->checkIfExist('offer')) {
            throw new ErrorException('Offer is not defined');
        }

        $entityUpdater->setEntity($offer);
        $entityUpdater->update($requestPostContentData->getValue('offer'));
        $entityUpdater->flush();

        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin']]),
        ], 200);
    }

    /**
     * @param Offers $offer
     * @param RemoveOffer $removeOffer
     * @Route("/admin/api/offers/remove/{offer}", name="admin-api-offers-remove", methods={"POST"})
     */
    public function remove(Offers $offer, RemoveOffer $removeOffer)
    {
        try {
            $id = $offer->getIdOffer();
            if (!$removeOffer->removeOffer($offer)) {
                throw new ErrorException("Błąd podczas usuwania");
            }
            return $this->responseJson(['message' => 'Usunięto oferte o id ' . $id], 200);

        } catch (Exception $exception) {
            return $this->responseJson(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/offers/offer/{offer}", name="admin-api-offers-offer", methods={"POST"})
     */
    public function offer(Offers $offer)
    {
        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin']]),
        ], 200);
    }


    /**
     * @param RequestPostContentData $contentData
     * @Route("/admin/api/offers/loadPhoto/{offer}", name="admin-api-offers-loadPhoto", methods={"POST"})
     */
    public function loadPhoto(RequestPostContentData $contentData, Offers $offer)
    {
        if (!$contentData->checkIfExist('path')) {
            return $this->json([
                'message' => "Ścieżka do pliku nie istnieje",
            ], 500);
        }

        if ($offer->getPhoto() === null) {
            $photo = new Files();
            $photo->setData('oferta '.$offer->getTitle(), 'alt');
            $photo->setPath($contentData->getValue('path'));
            $photo->setGroup('offer');
            $this->getDoctrine()->getManager()->persist($photo);
            $offer->setPhoto($photo);
        } else {
            $offer->getPhoto()->setPath($contentData->getValue('path'));
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }

    /**
     * @param RequestPostContentData $contentData
     * @Route("/admin/api/offers/removePhoto/{offer}", name="admin-api-offers-offer-removePhoto", methods={"POST"})
     */
    public function removePhoto(RequestPostContentData  $contentData, Offers $offer)
    {
        if ($offer->getPhoto()) {
            $this->getDoctrine()->getManager()->remove($offer->getPhoto());
            $offer->setPhoto(null);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }

    /**
     * @param Subpages $subpage
     * @param OffersRepository $offersRepository
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/offers/subpage/{subpage}", name="admin-api-offers-subpage", methods={"POST"})
     */
    public function subpage(Subpages $subpage, OffersRepository $offersRepository)
    {
        $offers = $offersRepository->select()->findOffersBySubpage($subpage)->getResults();

        return $this->json([
            'offers' => $this->normalizer->normalize($offers, null, ['groups' => ['resource-admin']]),
        ], 200);
    }
}
