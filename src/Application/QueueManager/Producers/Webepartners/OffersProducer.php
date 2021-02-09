<?php

namespace App\Application\QueueManager\Producers\Webepartners;

use App\Application\QueueManager\Consumers\Webepartners\OffersConsumer;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Services\QueueManager\ProducerManager;

class OffersProducer extends ProducerManager
{
    public function getCustomerClass(): string
    {
        return OffersConsumer::class;
    }

    public function addToQueue(ShopsAffiliation $shop)
    {

        $message = [
            'externalId' => $shop->getExternalId(),
            'affiliation' => $shop->getAffiliation()->getName()
        ];
        $this->add($message);
    }
}
