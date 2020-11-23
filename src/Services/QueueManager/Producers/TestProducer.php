<?php

namespace App\Services\QueueManager\Producers;

use App\Services\QueueManager\Consumers\TestConsumer;
use App\Services\QueueManager\ProducerManager;

class TestProducer extends ProducerManager
{
    public function getCustomerClass(): string
    {
        return TestConsumer::class;
    }

    public function addToQueue($value = null)
    {
        $message = [
            'test' => $value ?: rand(1, 10),
        ];
        $this->add($message);
    }
}
