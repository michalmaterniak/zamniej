<?php
namespace App\Application\Offers\Factory;

use App\Application\Images\ImageManager;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;
use ErrorException;
use Exception;

class OfferFactory extends OfferAbstractFactory
{
    /**
     * @var ShopsAffiliationRepository $shopsAffiliationRepository
     */
    protected $shopsAffiliationRepository;

    public function __construct(
        SimpleEntityUpdater $entityUpdater,
        ImageManager $imageManager,
        ShopsAffiliationRepository $shopsAffiliationRepository
    )
    {
        parent::__construct($entityUpdater, $imageManager);
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
    }

    public function getNewOfferEntity(): void
    {
        $this->offer = new Offers();
    }

    protected function prepareData(array &$data)
    {

        if (isset($data['shopAffiliation']) && is_numeric($data['shopAffiliation']) && $data['shopAffiliation'] > 0) {
            $data['shopAffiliation'] = $this->shopsAffiliationRepository->select()->byId($data['shopAffiliation'])->getResultOrNull();
            if (!$data['shopAffiliation']) {
                throw new ErrorException('Shop affiliation is not found');
            }
        } else {
            throw new ErrorException('Shop affiliation is not defined');
        }

        if (isset($data['subpage']) && is_numeric($data['subpage']) && $data['subpage'] > 0) {
            /**
             * @var ShopsAffiliation $shopAffiliation
             */
            $shopAffiliation = $data['shopAffiliation'];

            $data['subpage'] = $shopAffiliation->getSubpage();

            if (!$data['subpage']) {
                throw new ErrorException('Subpage is not found');
            }
        } else {
            throw new ErrorException('Subpage is not defined');
        }

        if (isset($data['code'])) {
            if ($data['code']) {
                $data['data']['code'] = $data['code'];
                unset($data['code']);
            } else {
                unset($data['code']);
            }
        }

        if (array_key_exists('datetimeTo', $data) && $data['datetimeTo'] == null) {
            unset($data['datetimeTo']);
        }
    }

    /**
     * @param array $data
     * @return Offers
     */
    public function create(array $data): Offers
    {

        $this->prepareData($data);

        try {
            $this->entityUpdater->getEntityManager()->beginTransaction();
            $this->getNewOfferEntity();
            $this->update($data);
            $this->offer->getContent()->setDisableNewContent(false);// TODO do usuniecia jak wejdzie nowy szabon
            $this->entityUpdater->getEntityManager()->persist($this->offer);
            $this->entityUpdater->getEntityManager()->flush();
            $this->createPhoto($data);
            $this->entityUpdater->flush();
            $this->entityUpdater->getEntityManager()->commit();
        } catch (Exception $exception) {
            $this->entityUpdater->getEntityManager()->rollback();
        }
        return $this->offer;
    }

    /**
     * @param array $offer
     */
    public function update(array $offer): void
    {
        $this->entityUpdater->setEntity($this->offer);
        $this->entityUpdater->update($offer);
    }
}
