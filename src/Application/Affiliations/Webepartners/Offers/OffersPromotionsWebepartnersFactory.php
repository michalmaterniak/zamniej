<?php

namespace App\Application\Affiliations\Webepartners\Offers;

use App\Application\Affiliations\Webepartners\Api\Vouchers\VouchersWebepartners;
use App\Application\Affiliations\Webepartners\OffersWebepartnersFactory;
use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\OfferFactoryManager;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPromotions;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersVouchers;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersPromotionsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersVouchersRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class OffersPromotionsWebepartnersFactory extends OffersWebepartnersFactory
{
    /**
     * @var VouchersWebepartners $apiVouchersWebepartners
     */
    protected $apiVouchersWebepartners;

    /**
     * @var WebepartnersVouchersRepository $webepartnersVouchersRepository
     */
    protected $webepartnersVouchersRepository;

    /**
     * @var WebepartnersPromotionsRepository $webepartnersPromotionsRepository
     */
    protected $webepartnersPromotionsRepository;

    /**
     * @var OfferFactoryManager $offerFactoryManager
     */
    protected $offerFactoryManager;

    /**
     * @var string $keyVoucher
     */
    protected $keyVoucher;

    /**
     * @var ArrayCollection|WebepartnersPromotions[]|WebepartnersVouchers[] $offers
     */
    protected $offers;

    /**
     * @var array $vouchers
     */
    private $vouchers;

    public function __construct(
        OfferFactoryManager $offerFactoryManager,
        EntityUpdater $entityUpdater,
        ImageManager $imageManager,

        VouchersWebepartners $apiVouchersWebepartners,
        WebepartnersVouchersRepository $webepartnersVouchersRepository,
        WebepartnersPromotionsRepository $webepartnersPromotionsRepository
    )
    {
        parent::__construct(
            $imageManager,
            $entityUpdater
        );
        $this->offerFactoryManager = $offerFactoryManager;
        $this->apiVouchersWebepartners = $apiVouchersWebepartners;
        $this->webepartnersVouchersRepository = $webepartnersVouchersRepository;
        $this->webepartnersPromotionsRepository = $webepartnersPromotionsRepository;
    }

    public function findOffers($program): void
    {
        $this->keyVoucher = (new DateTime())->format('dmY');

        $this->loadPromotions($program);
    }

    /**
     * @param WebepartnersPrograms $program
     */
    protected function loadPromotions(WebepartnersPrograms $program)
    {
        try {
            $vouchers = $this->getPromotions();

            if (!empty($vouchers[$this->keyVoucher][$program->getProgramId()])) {
                foreach ($vouchers[$this->keyVoucher][$program->getProgramId()] as $voucherWebe) {
                    $voucher = $this->webepartnersVouchersRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();

                    if (!$voucher)
                        $voucher = $this->webepartnersPromotionsRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();

                    if (!$voucher) {
                        if ($voucherWebe['voucherCode'])
                            $voucher = new WebepartnersVouchers();
                        else
                            $voucher = new WebepartnersPromotions();
                        $voucher->setShopAffiliation($program);

                        $this->entityUpdater->setEntity($voucher);
                        $this->entityUpdater->update($voucherWebe);

                        $this->entityUpdater->persist($voucher);
                        $this->entityUpdater->flush();

                        $this->offerFactoryManager->create($voucher);
                    }
                }
            }
        } catch (ConnectException $connectException) {
            dump("błąd podczas połączenia z webepartners. Oferty ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        } catch (Exception $exception) {
            dump("Oferty ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        }
    }

    /**
     * @return array
     */
    private function getPromotions()
    {
        if (!isset($this->vouchers[$this->keyVoucher])) {
            $this->vouchers = [];
            $vouchersWebe = $this->apiVouchersWebepartners->getVouchers(
                (new DateTime())->modify('-2 years'),
                (new DateTime())
            );
            foreach ($vouchersWebe as $item) {
                if (empty($this->vouchers[$this->keyVoucher][$item['programId']]))
                    $this->vouchers[$this->keyVoucher][$item['programId']] = [];

                $this->vouchers[$this->keyVoucher][$item['programId']][] = $item;
            }
        }
        return $this->vouchers;
    }


}
