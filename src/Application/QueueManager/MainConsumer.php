<?php
namespace App\Application\QueueManager;

use App\Application\QueueManager\Consumers\Webepartners\OffersConsumer;
use App\Application\QueueManager\Consumers\Webepartners\ProgramsConsumer;
use App\Services\QueueManager\MainConsumer as GlobalMainConsumer;

class MainConsumer extends GlobalMainConsumer
{
    public function __construct()
    {
    }
}
