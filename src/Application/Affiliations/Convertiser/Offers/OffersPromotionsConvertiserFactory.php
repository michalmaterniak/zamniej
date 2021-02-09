<?php

namespace App\Application\Affiliations\Convertiser\Offers;

use App\Application\Affiliations\Convertiser\Api\Offers\OffersConvertiser;
use App\Application\Affiliations\Convertiser\Api\Offers\OfferTrackingUrlConvertiser;
use App\Application\Affiliations\Convertiser\OffersConvertiserFactory;
use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\Managers\OfferEntityFactoryManager;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPromotions;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserVouchers;
use App\Repository\Repositories\Affiliations\Convertiser\ConvertiserPromotionsRepository;
use App\Repository\Repositories\Affiliations\Convertiser\ConvertiserVouchersRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class OffersPromotionsConvertiserFactory extends OffersConvertiserFactory
{
    /**
     * @var OffersConvertiser $apiOffersConvertiser
     */
    protected $apiOffersConvertiser;

    /**
     * @var ConvertiserPromotionsRepository $convertiserPromotionsRepository
     */
    protected $convertiserPromotionsRepository;

    /**
     * @var ConvertiserVouchersRepository $convertiserVouchersRepository
     */
    protected $convertiserVouchersRepository;

    /**
     * @var OfferEntityFactoryManager $offerFactoryManager
     */
    protected $offerFactoryManager;

    /**
     * @var ArrayCollection|ConvertiserVouchers[]|ConvertiserPromotions[] $offers
     */
    protected $offers;

    /**
     * @var OfferTrackingUrlConvertiser $offerTrackingUrlConvertiser
     */
    protected $offerTrackingUrlConvertiser;


    public function __construct(
        OfferEntityFactoryManager $offerFactoryManager,
        SimpleEntityUpdater $entityUpdater,
        ImageManager $imageManager,
        OfferTrackingUrlConvertiser $offerTrackingUrlConvertiser,


        OffersConvertiser $apiOffersConvertiser,
        ConvertiserPromotionsRepository $convertiserPromotionsRepository,
        ConvertiserVouchersRepository $convertiserVouchersRepository
    )
    {
        parent::__construct(
            $imageManager,
            $entityUpdater
        );
        $this->offerFactoryManager = $offerFactoryManager;
        $this->apiOffersConvertiser = $apiOffersConvertiser;
        $this->convertiserPromotionsRepository = $convertiserPromotionsRepository;
        $this->convertiserVouchersRepository = $convertiserVouchersRepository;
        $this->offerTrackingUrlConvertiser = $offerTrackingUrlConvertiser;
    }


    public function findOffers($program): void
    {
        $this->loadPromotions($program);
    }

    /**
     * @param ConvertiserPromotions $voucher
     * @return mixed
     */
    protected function addUrlTracking($voucher)
    {
        $urlTracking = $this->offerTrackingUrlConvertiser->getOfferTrackingUrl(
            $voucher->getId(),
            $voucher->getShopAffiliation()->getAffiliation()->getData('website')
        );

        $voucher->setUrlTracking($urlTracking);
    }

    /**
     * @param ConvertiserPrograms $program
     */
    protected function loadPromotions($program)
    {
        try {
            foreach ($this->apiOffersConvertiser->getPromotionsProgram($program->getExternalId()) as $promotionConvertiser) {
                $voucher = $this->convertiserPromotionsRepository->select(false)->externalId($promotionConvertiser['id'])->getResultOrNull();

                if (!$voucher)
                    $voucher = $this->convertiserVouchersRepository->select(false)->externalId($promotionConvertiser['id'])->getResultOrNull();

                if (!$voucher) {
                    try {
                        $this->entityUpdater->getEntityManager()->beginTransaction();

                        if ($promotionConvertiser['subtype'] === 'promo_code')
                            $voucher = new ConvertiserVouchers();
                        else
                            $voucher = new ConvertiserPromotions();

                        $voucher->setShopAffiliation($program);

                        $this->entityUpdater->setEntity($voucher);
                        $this->entityUpdater->update($promotionConvertiser);

                        $this->addUrlTracking($voucher);

                        $this->entityUpdater->persist($voucher);
                        $this->entityUpdater->flush();

                        $this->offerFactoryManager->create($voucher);

                        $this->entityUpdater->getEntityManager()->commit();
                    } catch (Exception $exception) {
                        dump('nie udało się utworzyć oferty convertiser');
                        $this->entityUpdater->getEntityManager()->rollback();
                    }
                }
            }
        } catch (ConnectException $connectException) {
            dump("błąd podczas połączenia z convertiser. Promocje ze sklepu " . $program->getName() . " nie zostaną pobrane");
        } catch (Exception $exception) {
            dump("Promocje ze sklepu " . $program->getName() . " nie zostaną pobrane: " . $exception->getMessage());
        }
    }
}
