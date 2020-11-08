<?php
namespace App\Controller\Admin\Api\Offers;

use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\Files;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{

    /**
     * @param Offers $offer
     * @param EntityUpdater $entityUpdater
     * @param RequestPostContentData $requestPostContentData
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \ErrorException
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @Route("/admin/api/offers/store/{offer}", name="admin-api-offers-store", methods={"POST"})
     */
    public function store(Offers $offer, EntityUpdater $entityUpdater, RequestPostContentData $requestPostContentData)
    {
        if (!$requestPostContentData->checkIfExist('offer')) {
            throw new \ErrorException('Offer is not defined');
        }

        $entityUpdater->setEntity($offer);
        $entityUpdater->update($requestPostContentData->getValue('offer'));
        $entityUpdater->flush();

        return $this->json([
            'offer' => $this->normalizer->normalize($offer, null, ['groups' => ['resource-admin']]),
        ], 200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
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
     * @param OffersRepository $offersRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
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
