<?php
namespace App\Application\Affiliations\Webepartners;
use App\Application\Affiliations\Webepartners\Api\Banners\BannersWebepartners;
use App\Application\Affiliations\Webepartners\Api\HotPrice\HotPriceWebepartners;
use App\Application\Affiliations\Webepartners\Api\Vouchers\VouchersWebepartners;
use App\Application\Images\ImageManager;
use App\Application\Offers\Factory\OfferFactoryManager;
use App\Application\Offers\Factory\Offers\OfferPromotionFactory;
use App\Application\Offers\Factory\Offers\OfferVoucherFactory;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersBanners;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersHotPrices;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPromotions;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersVouchers;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersBannersRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersHotPricesRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersPromotionsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersVouchersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class OffersFactoryWebepartners
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var WebepartnersVouchersRepository $webepartnersVouchersRepository
     */
    protected $webepartnersVouchersRepository;

    /**
     * @var WebepartnersBannersRepository $webepartnersVouchersRepository
     */
    protected $webepartnersBannersRepository;

    /**
     * @var WebepartnersHotPricesRepository $webepartnersHotPricesRepository
     */
    protected $webepartnersHotPricesRepository;

    /**
     * @var WebepartnersPromotionsRepository $webepartnersPromotionsRepository
     */
    protected $webepartnersPromotionsRepository;

    /**
     * @var ArrayCollection|WebepartnersPrograms[] $programs
     */
    protected $programs;

    /**
     * @var array $vouchers
     */
    protected $vouchers;

    /**
     * @var VouchersWebepartners $vouchersWebepartners
     */
    protected $vouchersWebepartners;

    /**
     * @var BannersWebepartners $bannersWebepartners
     */
    protected $bannersWebepartners;
    /**
     * @var string $keyVoucher
     */
    protected $keyVoucher;
    /**
     * @var HotPriceWebepartners $hotPricesWebepartners
     */
    protected $hotPricesWebepartners;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    /**
     * @var OfferFactoryManager $offerFactoryManager
     */
    protected $offerFactoryManager;

    public function __construct(
        EntityManagerInterface $entityManager,

        VouchersWebepartners  $vouchersWebepartners,
        BannersWebepartners $bannersWebepartners,
        HotPriceWebepartners $hotPricesWebepartners,

        WebepartnersProgramsRepository  $webepartnersProgramsRepository,
        WebepartnersPromotionsRepository $webepartnersPromotionsRepository,
        WebepartnersVouchersRepository $webepartnersVouchersRepository,
        WebepartnersBannersRepository $webepartnersBannersRepository,
        WebepartnersHotPricesRepository $webepartnersHotPricesRepository,
        OfferFactoryManager $offerFactoryManager
    )
    {
        $this->entityManager = $entityManager;

        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
        $this->webepartnersVouchersRepository = $webepartnersVouchersRepository;
        $this->webepartnersPromotionsRepository = $webepartnersPromotionsRepository;
        $this->webepartnersBannersRepository = $webepartnersBannersRepository;
        $this->webepartnersHotPricesRepository = $webepartnersHotPricesRepository;

        $this->vouchersWebepartners = $vouchersWebepartners;
        $this->bannersWebepartners = $bannersWebepartners;
        $this->hotPricesWebepartners = $hotPricesWebepartners;

        $this->offerFactoryManager = $offerFactoryManager;

        $this->programs = [];
        $this->vouchers = [];
    }

    /**
     * @param ImageManager $imageManager
     * @required
     */
    public function setImageManager(ImageManager $imageManager): void
    {
        $this->imageManager = $imageManager;
    }

    protected function getProgram(int $idWebe) : ?WebepartnersPrograms
    {
        if(empty($this->programs[$idWebe]))
            $this->programs[$idWebe] = $this->webepartnersProgramsRepository->getProgramByWebeId($idWebe);

        return $this->programs[$idWebe] ?? null;
    }

    /**
     * @param int|WebepartnersPrograms $programId
     */
    public function findOffers($programId) : void
    {
        $this->keyVoucher = (new \DateTime())->format('dmY');

        try
        {
            $program = null;
            if(is_object($programId) && $programId instanceof WebepartnersPrograms)
                $program = $programId;
            else if(is_numeric($programId))
                $program = $this->getProgram($programId);

            if($program && $program->isEnable())
            {
                $this->loadVouchers($program);
                $this->loadBanners($program);
                $this->loadHotPrices($program);
            }
        }
        catch (\Throwable $exception)
        {
            dump($exception);
            die;
        }
    }

    protected function getVouchers()
    {
        if(!isset($this->vouchers[$this->keyVoucher]))
        {
            $this->vouchers = [];
            $vouchersWebe = $this->vouchersWebepartners->getVouchers(
                (new \DateTime())->modify('-2 years'),
                new \DateTime()
            );
            foreach ($vouchersWebe as $item)
            {
                if(empty($this->vouchers[$this->keyVoucher][$item['programId']]))
                    $this->vouchers[$this->keyVoucher][$item['programId']] = [];

                $this->vouchers[$this->keyVoucher][$item['programId']][] = $item;
            }
        }
        return $this->vouchers;
    }

    private function updateEntity($values, $entity)
    {
        foreach ($values as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if(method_exists($entity, $method))
                $entity->$method($value);
        }
    }
    protected function loadVouchers(WebepartnersPrograms $program)
    {
        $vouchers = $this->getVouchers();
        if(!empty($vouchers[$this->keyVoucher][$program->getProgramId()]))
        {
            foreach ($vouchers[$this->keyVoucher][$program->getProgramId()] as $voucherWebe)
            {
                $voucher = $this->webepartnersVouchersRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();
                if(!$voucher)
                    $voucher = $this->webepartnersPromotionsRepository->select(false)->findOneByWebeId($voucherWebe['voucherId'])->getResultOrNull();

                if(!$voucher)
                {
                    if($voucherWebe['voucherCode'])
                        $voucher = new WebepartnersVouchers();
                    else
                        $voucher = new WebepartnersPromotions();
                    $voucher->setShopAffiliation($program);

                    $this->updateEntity($voucherWebe, $voucher);
                    $this->entityManager->persist($voucher);
                    $this->entityManager->flush();

                    $this->offerFactoryManager->create($voucher);

                }
            }
        }
    }
    protected function loadBanners(WebepartnersPrograms  $program)
    {
        $bannersWebe = $this->bannersWebepartners->getBanners($program->getProgramId());
        foreach ($bannersWebe as $bannerWebe)
        {
            $banner = $this->webepartnersBannersRepository->select(false)->findOneByWebeId($bannerWebe['bannerId'])->getResultOrNull();
            if(!$banner)
            {
                $banner = new WebepartnersBanners();
                $banner->setShopAffiliation($program);

                $this->updateEntity($bannerWebe, $banner);
                $this->entityManager->persist($banner);
                $this->entityManager->flush();
            }
        }
    }
    protected function loadHotPrices(WebepartnersPrograms  $program)
    {
        $hotPricesWebe = $this->hotPricesWebepartners->getHotPrice($program->getProgramId());
        foreach ($hotPricesWebe as $hotPriceWebe)
        {
            if(!isset($hotPriceWebe['productImages']) || !isset($hotPriceWebe['productImages']['productImagesUrl']) || count($hotPriceWebe['productImages']['productImagesUrl']) === 0)
                continue;
            $hotPrice = $this->webepartnersHotPricesRepository->select(false)->findOneByWebeId($hotPriceWebe['webeProductId'])->getResultOrNull();
            if(!$hotPrice)
            {
                $hotPrice = new WebepartnersHotPrices();
                $hotPrice->setShopAffiliation($program);

                $this->updateEntity($hotPriceWebe, $hotPrice);
                $this->entityManager->persist($hotPrice);
            }
            else
            {
                $this->updateEntity($hotPriceWebe, $hotPrice);
            }
            $this->entityManager->flush();
        }
    }

}
