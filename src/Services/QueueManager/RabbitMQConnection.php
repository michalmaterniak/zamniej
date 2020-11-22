<?php
namespace App\Services\QueueManager;

use ErrorException;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnection
{
    /**
     * @var string $queue
     */
    private $queue;
    private $port;
    private $host;
    private $user;
    private $pass;

    /**
     * @var AMQPStreamConnection|null $connection
     */
    protected $connection;

    public function __construct(array $rabbitmq)
    {
        $this->queue = $rabbitmq['queue'];
        $this->port = $rabbitmq['port'];
        $this->host = $rabbitmq['host'];
        $this->user = $rabbitmq['user'];
        $this->pass = $rabbitmq['pass'];

        $this->connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->user,
            $this->pass
        );
    }

    /**
     * @return AMQPStreamConnection
     * @throws ErrorException
     */
    public function getConnection(): AMQPStreamConnection
    {
        if (!$this->connection) {
            throw new ErrorException('connection have to be defined');
        }

        return $this->connection;
    }

    /**
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }
}
