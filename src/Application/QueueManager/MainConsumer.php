<?php
namespace App\Application\QueueManager;

use App\Application\QueueManager\Consumers\Webepartners\OffersConsumer;
use App\Services\QueueManager\Consumers\KillConsumer;
use App\Services\QueueManager\Consumers\TestConsumer;
use App\Services\QueueManager\MainConsumer as GlobalMainConsumer;

class MainConsumer extends GlobalMainConsumer
{
    public function __construct(
        KillConsumer $killConsumer,
        TestConsumer $testConsumer,
        OffersConsumer $offersConsumer
    )
    {
        $this->registerConsumer($killConsumer);
        $this->registerConsumer($testConsumer);
        $this->registerConsumer($offersConsumer);
    }
}
