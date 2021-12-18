<?php

namespace App\Application\Affiliations\Tradetracker\Offers;

use App\Application\Affiliations\Tradetracker\Api\Offers\PromotionsTradetracker;
use App\Application\Affiliations\Tradetracker\Api\Offers\VouchersTradetracker;
use App\Application\Affiliations\Tradetracker\OffersTradetrackerFactory;
use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\Managers\OfferEntityFactoryManager;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPromotions;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerVouchers;
use App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerPromotionsRepository;
use App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerVouchersRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class OffersPromotionsTradetrackerFactory extends OffersTradetrackerFactory
{
    /**
     * @var ArrayCollection|null $promotions
     */
    protected $promotions = null;

    /**
     * @var null|ArrayCollection $vouchers
     */
    protected $vouchers = null;

    protected array $currentPromotion;

    /**
     * @var TradetrackerVouchers|TradetrackerPromotions $currentPromotionEntity
     */
    protected $currentPromotionEntity;

    /**
     * @var TradetrackerPrograms $currentProgram
     */
    protected $currentProgram;

    public function __construct(
        protected OfferEntityFactoryManager $offerFactoryManager,
        protected PromotionsTradetracker $apiPromotionsTradetracker,
        protected VouchersTradetracker $apiVouchersTradetracker,
        protected TradetrackerPromotionsRepository $tradetrackerPromotionsRepository,
        protected TradetrackerVouchersRepository $tradetrackerVouchersRepository,
        SimpleEntityUpdater $entityUpdater,
        ImageManager $imageManager
    )
    {
        parent::__construct(
            $imageManager,
            $entityUpdater
        );
    }

    public function findOffers($program): void
    {
        $this->currentProgram = $program;
        $this->loadPromotions();
        $this->loadVouchers();
    }

    protected function loadVouchers() {
        if ($this->vouchers === null)
        {
            $this->vouchers = $this->apiVouchersTradetracker->getPromotions();
        }

        $vouchers = $this->promotions->filter(
            function ($item) {
                return (int)$item['campaignId'] === (int)$this->currentProgram->getExternalId();
            }
        );

        foreach ($vouchers as $this->currentPromotion)
        {
            if ($this->tradetrackerPromotionsRepository->counting(false)->externalId($this->currentPromotion['id'])->getCount() > 0)
            {
                continue;
            }
            $this->currentPromotionEntity = new TradetrackerVouchers();

            $this->transaction();
        }

    }

    /**
     * @return mixed
     */
    protected function loadPromotions() {
        if ($this->promotions === null)
        {
            $this->promotions = $this->apiPromotionsTradetracker->getPromotions();
        }
        $promotions = $this->promotions->filter(
            function ($item) {
                return (int)$item['campaignId'] === (int)$this->currentProgram->getExternalId();
            }
        );

        foreach ($promotions as $this->currentPromotion)
        {
            if ($this->tradetrackerPromotionsRepository->counting(false)->externalId($this->currentPromotion['id'])->getCount() > 0)
            {
                continue;
            }
            $this->currentPromotionEntity = new TradetrackerPromotions();

            $this->transaction();

        }
    }

    /**
     * @return void
     */
    protected function transaction()
    {
        try {
            $this->entityUpdater->getEntityManager()->beginTransaction();

            $this->currentPromotionEntity->setShopAffiliation($this->currentProgram);

            $this->entityUpdater->setEntity($this->currentPromotionEntity);
            $this->entityUpdater->update($this->currentPromotion);

            if ($this->currentPromotionEntity->getUrlTracking() === '')
            {
                $this->currentPromotionEntity->setUrlTracking($this->currentProgram->getTrackingURL());
            }
            if ($this->currentPromotionEntity->getUrlImage())
            {
                $this->currentPromotionEntity->setUrlImage($this->currentProgram->getImageURL());
            }

            $this->entityUpdater->persist($this->currentPromotionEntity);
            $this->entityUpdater->flush();

            $this->offerFactoryManager->create($this->currentPromotionEntity);

            $this->entityUpdater->getEntityManager()->commit();
        } catch (Exception $exception) {
            dump('nie udało się utworzyć oferty tradetracker');
            $this->entityUpdater->getEntityManager()->rollback();
        }
    }

}
