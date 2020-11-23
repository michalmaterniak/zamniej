<?php

namespace App\Services\QueueManager\Producers;

use App\Services\QueueManager\Consumers\KillConsumer;
use App\Services\QueueManager\ProducerManager;

class KillProducer extends ProducerManager
{
    public function getCustomerClass(): string
    {
        return KillConsumer::class;
    }

    public function addToQueue()
    {
        $message = [
            'kill' => true
        ];
        $this->add($message, [
            'config' => 999
        ]);
    }
}
