<?php
namespace App\Application\Affiliations\Webepartners\Offers;

use App\Application\Affiliations\Webepartners\Api\Vouchers\VouchersWebepartners;
use App\Application\Affiliations\Webepartners\OffersWebepartnersFactory;
use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\Managers\OfferEntityFactoryManager;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPromotions;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersVouchers;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersPromotionsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersVouchersRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;
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
     * @var OfferEntityFactoryManager $offerFactoryManager
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
        OfferEntityFactoryManager $offerFactoryManager,
        SimpleEntityUpdater $entityUpdater,
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
            foreach ($this->apiVouchersWebepartners->getOffers($program->getProgramId()) as $voucherWebe) {
                $voucher = $this->webepartnersVouchersRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();

                if (!$voucher)
                    $voucher = $this->webepartnersPromotionsRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();

                if (!$voucher) {
                    try {
                        $this->entityUpdater->getEntityManager()->beginTransaction();

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

                        $this->entityUpdater->getEntityManager()->commit();
                    } catch (Exception $exception) {
                        dump('nie udało się utworzyć oferty webe');
                        $this->entityUpdater->getEntityManager()->rollback();
                    }
                }
            }
        } catch (ConnectException $connectException) {
            dump("błąd podczas połączenia z webepartners. Promocje ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        } catch (Exception $exception) {
            dump("Promocje ze sklepu " . $program->getProgramName() . " nie zostaną pobrane: " . $exception->getMessage());
        }
    }
}
