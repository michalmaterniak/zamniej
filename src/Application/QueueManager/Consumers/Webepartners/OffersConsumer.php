<?php
namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Services\QueueManager\Interfaces\Consumer;

class OffersConsumer implements Consumer
{
    /**
     * @var FinderOffersWebepartners $finderOffersWebepartners
     */
    protected $finderOffersWebepartners;

    public function __construct(FinderOffersWebepartners $finderOffersWebepartners)
    {
        $this->finderOffersWebepartners = $finderOffersWebepartners;
    }

    public function run(array $data = []): void
    {
        $this->finderOffersWebepartners->loadOffersByExternalId((int)$data['externalId']);
    }
}
