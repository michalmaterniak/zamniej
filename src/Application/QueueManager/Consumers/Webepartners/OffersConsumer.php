<?php

namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Services\QueueManager\Interfaces\Consumer;

class OffersConsumer implements Consumer
{
    /**
     * @var ShopsAffiliationRepository $shopsAffiliationRepository
     */
    protected $shopsAffiliationRepository;

    /**
     * @var FinderOffersWebepartners $finderOffersWebepartners
     */
    protected $finderOffersWebepartners;

    public function __construct(
        FinderOffersWebepartners $finderOffersWebepartners,
        ShopsAffiliationRepository $shopsAffiliationRepository
    )
    {
        $this->finderOffersWebepartners = $finderOffersWebepartners;
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
    }

    public function run(array $data = []): void
    {
        if ($program = $this->shopsAffiliationRepository->select()->getProgramByAfiliationExternal($data['externalId'])->getResultOrNull()) {
            switch ($data['affiliation']) {
                case 'webepartners' :
                {
                    $this->finderOffersWebepartners->loadOffers($program);
                }

                case 'convertiser' :
                {
                    // @todo dodać pobieranie ofert z kon
                }
            }
            dump('pobrano z ' . $program->getName());
        } else {
            dump("nie znaleziono progrmau o zewnętrzyn id: {$data['externalId']}");
        }
    }
}
