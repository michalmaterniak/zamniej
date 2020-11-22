<?php

namespace App\Application\Affiliations\Webepartners\Offers;

use App\Application\Affiliations\Webepartners\Api\Banners\BannersWebepartners;
use App\Application\Affiliations\Webepartners\OffersWebepartnersFactory;
use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersBanners;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersBannersRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class OffersBannersWebepartnersFactory extends OffersWebepartnersFactory
{
    /**
     * @var BannersWebepartners $apiBannersWebepartners
     */
    protected $apiBannersWebepartners;

    /**
     * @var WebepartnersBannersRepository $webepartnersBannersRepository
     */
    protected $webepartnersBannersRepository;

    /**
     * @var ArrayCollection|WebepartnersBanners[] $offers
     */
    protected $offers;

    public function __construct(
        EntityUpdater $entityUpdater,
        ImageManager $imageManager,

        BannersWebepartners $apiBannersWebepartners,
        WebepartnersBannersRepository $webepartnersBannersRepository
    )
    {
        parent::__construct(
            $imageManager,
            $entityUpdater
        );
        $this->apiBannersWebepartners = $apiBannersWebepartners;
        $this->webepartnersBannersRepository = $webepartnersBannersRepository;
    }

    public function findOffers($program): void
    {
        $this->loadBanners($program);
    }

    private function loadBanners(WebepartnersPrograms $program)
    {
        try {
            $bannersWebe = $this->apiBannersWebepartners->getBanners($program->getProgramId());
            foreach ($bannersWebe as $bannerWebe) {
                $banner = $this->webepartnersBannersRepository->select(false)->findOneByWebeId($bannerWebe['bannerId'])->getResultOrNull();
                if (!$banner) {
                    $banner = new WebepartnersBanners();
                    $banner->setShopAffiliation($program);

                    $this->entityUpdater->setEntity($banner);
                    $this->entityUpdater->update($bannersWebe);

                    $this->entityUpdater->persist($banner);
                    $this->entityUpdater->flush();

                }
            }
        } catch (ConnectException $connectException) {
            dump("błąd podczas połączenia z webepartners. Oferty ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        } catch (Exception $exception) {
            dump("Oferty ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        }
    }
}
