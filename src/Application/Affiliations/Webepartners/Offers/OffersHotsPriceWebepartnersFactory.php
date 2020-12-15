<?php
namespace App\Application\Affiliations\Webepartners\Offers;

use App\Application\Affiliations\Webepartners\Api\HotPrice\HotPriceWebepartners;
use App\Application\Affiliations\Webepartners\OffersWebepartnersFactory;
use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersBanners;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersHotPrices;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersHotPricesRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class OffersHotsPriceWebepartnersFactory extends OffersWebepartnersFactory
{
    /**
     * @var HotPriceWebepartners $apiHotPriceWebepartners
     */
    protected $apiHotPriceWebepartners;

    /**
     * @var WebepartnersHotPricesRepository $webepartnersHotPricesRepository
     */
    protected $webepartnersHotPricesRepository;

    /**
     * @var ArrayCollection|WebepartnersBanners[] $offers
     */
    protected $offers;

    public function __construct(
        SimpleEntityUpdater $entityUpdater,
        ImageManager $imageManager,

        HotPriceWebepartners $apiHotPriceWebepartners,
        WebepartnersHotPricesRepository $webepartnersHotPricesRepository
    )
    {
        parent::__construct(
            $imageManager,
            $entityUpdater
        );
        $this->apiHotPriceWebepartners = $apiHotPriceWebepartners;
        $this->webepartnersHotPricesRepository = $webepartnersHotPricesRepository;
    }

    public function findOffers($program): void
    {
        $this->loadHotPrices($program);
    }

    protected function loadHotPrices(WebepartnersPrograms $program)
    {
        try {
            $hotPricesWebe = $this->apiHotPriceWebepartners->getHotPrice($program->getProgramId());

            foreach ($hotPricesWebe as $hotPriceWebe) {
                if (!isset($hotPriceWebe['productImages']) || !isset($hotPriceWebe['productImages']['productImagesUrl']) || count($hotPriceWebe['productImages']['productImagesUrl']) === 0)
                    continue;

                $hotPrice = $this->webepartnersHotPricesRepository->select(false)->findOneByWebeId($hotPriceWebe['webeProductId'])->getResultOrNull();
                if (!$hotPrice) {
                    $hotPrice = new WebepartnersHotPrices();
                    $hotPrice->setShopAffiliation($program);

                    $this->entityUpdater->setEntity($hotPrice);
                    $this->entityUpdater->update($hotPriceWebe);

                    $this->entityUpdater->persist($hotPrice);

                } else {
                    $this->entityUpdater->setEntity($hotPrice);
                    $this->entityUpdater->update($hotPriceWebe);
                }
                $this->entityUpdater->flush();
            }
        } catch (ConnectException $connectException) {
            dump("błąd podczas połączenia z webepartners. HotPrice ze sklepu " . $program->getProgramName() . " nie zostaną pobrane");
        } catch (Exception $exception) {
            dump("HotPrice ze sklepu " . $program->getProgramName() . " nie zostaną pobrane: " . $exception->getMessage());
        }
    }
}
