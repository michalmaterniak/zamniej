<?php
namespace App\Application\QueueManager\Producers\Webepartners;

use App\Application\QueueManager\Consumers\Webepartners\ProgramsConsumer;
use App\Services\QueueManager\ProducerManager;

class ProgramsProducer extends ProducerManager
{
    public function getCustomerClass() : string
    {
        return ProgramsConsumer::class;
    }
    public function addToQueue(array $program)
    {
        $message = [
            'program' => $program,
        ];
        $this->add($message);
    }
}
