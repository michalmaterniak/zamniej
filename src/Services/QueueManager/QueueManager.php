<?php
namespace App\Services\QueueManager;

use PhpAmqpLib\Channel\AMQPChannel;

abstract class QueueManager
{
    /**
     * @var RabbitMQConnection $connection
     */
    protected $connection;

    /**
     * @var AMQPChannel $channel
     */
    protected $channel;

    /**
     * @var string
     */
    protected $nameQueue = 'default';

    public function __construct(RabbitMQConnection $rabbitMQConnection)
    {
        $this->nameQueue = $rabbitMQConnection->getQueue();
        $this->connection = $rabbitMQConnection;
        $this->setChannel();
    }

    abstract protected function setChannel(): void;

    public function getNameQueue() : string
    {
        return $this->nameQueue;
    }
}
