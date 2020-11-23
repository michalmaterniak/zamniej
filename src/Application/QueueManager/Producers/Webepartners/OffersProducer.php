<?php
namespace App\Application\QueueManager\Producers\Webepartners;

use App\Application\QueueManager\Consumers\Webepartners\OffersConsumer;
use App\Services\QueueManager\ProducerManager;

class OffersProducer extends ProducerManager
{
    public function getCustomerClass(): string
    {
        return OffersConsumer::class;
    }

    public function addToQueue(int $programId)
    {
        $message = [
            'externalId' => $programId,
        ];
        $this->add($message);
    }
}
