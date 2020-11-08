<?php
namespace App\Services\QueueManager;

use App\Services\QueueManager\Interfaces\Consumer;

class MainConsumer
{
    /**
     * @var Consumer[] $consumers
     */
    protected $consumers;

    protected function registerConsumer(Consumer $consumer)
    {
        $this->consumers[get_class($consumer)] = $consumer;
    }

    public function getConsumer(string $class) : ?Consumer
    {
        return $this->consumers[$class] ?? null;
    }
}
