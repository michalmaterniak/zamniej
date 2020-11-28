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
        $program = $this->shopsAffiliationRepository->select()->getProgramByWebeId($data['externalId'])->getResultOrNull();
        if ($program) {
            $this->finderOffersWebepartners->loadOffers($program);
        }
    }
}
