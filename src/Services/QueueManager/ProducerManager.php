<?php
namespace App\Services\QueueManager;

use App\Services\QueueManager\Interfaces\Producer;
use PhpAmqpLib\Message\AMQPMessage;

abstract class ProducerManager extends QueueManager implements Producer
{

    protected function setChannel(): void
    {
        $this->channel = $this->connection->getConnection()->channel();

        $this->channel->queue_declare(
            $queue = $this->getNameQueue(), // nazwa kolejki
            $passive = false, // passive
            $durable = true, // durable
            $exclusive = false, // exclusive
            $auto_delete = false, // auto deete
            $nowait = false, // nowait
            $arguments = null, // arguments
            $ticket = null // ticket
        );
    }
    abstract protected function getCustomerClass() : string;

    final protected function add(array $data, $config = [])
    {
        $message = [];
        $message['class'] = $this->getCustomerClass();
        $message['data'] = $data;
        $msg = new AMQPMessage(json_encode($message), $config);
        $this->channel->basic_publish($msg, '', $this->getNameQueue());
    }
}
