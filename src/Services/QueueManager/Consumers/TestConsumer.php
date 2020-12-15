<?php
namespace App\Services\QueueManager\Consumers;

use App\Services\QueueManager\Interfaces\Consumer;

class TestConsumer implements Consumer
{
    public function run(array $data = []): void
    {
        dump('test retrieve: ' . $data['test']);
    }
}
