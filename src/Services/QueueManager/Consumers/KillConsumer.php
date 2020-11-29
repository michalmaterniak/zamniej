<?php

namespace App\Services\QueueManager\Consumers;

use App\Services\QueueManager\Interfaces\Consumer;

class KillConsumer implements Consumer
{
    public function __construct()
    {
    }

    public function run(array $data = []): void
    {
    }
}
