<?php
namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\OffersWebepartnersFactoryFacade;
use App\Services\QueueManager\Interfaces\Consumer;

class OffersConsumer implements Consumer
{
    /**
     * @var OffersWebepartnersFactoryFacade $offersFactory
     */
    protected $offersFactory;

    public function __construct(OffersWebepartnersFactoryFacade $offersFactory)
    {
        $this->offersFactory = $offersFactory;
    }

    public function run(array $data): void
    {
        $this->offersFactory->loadOffers($data);
        $this->offersFactory->save($data['program']);
    }
}
