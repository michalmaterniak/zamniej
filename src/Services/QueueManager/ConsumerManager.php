<?php
namespace App\Services\QueueManager;

use App\Application\QueueManager\MainConsumer;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumerManager extends QueueManager
{
    protected $nameQueue = 'default';

    /**
     * @var MainConsumer $mainConsumer
     */
    protected $mainConsumer;

    public function __construct(
        RabbitMQConnection $connection,
        MainConsumer $mainConsumer
    ) {
        parent::__construct($connection);
        $this->mainConsumer = $mainConsumer;
    }

    protected function setChannel() : void
    {
        $this->channel = $this->connection->getConnection()->channel();
        $this->channel->basic_consume(
            $this->getNameQueue(),
            '',
            false,
            false,
            false,
            false,
            $this->callback()
        );
    }

    protected function callback()
    {
        return function ($msg) {
            //throw new \ErrorException('something wrong');

            /**
             * @var AMQPMessage $msg
             */
            $data = json_decode($msg->getBody(), true);
            if ($data && array_key_exists('data', $data) && array_key_exists('class', $data)) {
                $consumer = $this->mainConsumer->getConsumer($data['class']);
                if ($consumer) {
                    try {
                        //throw new \ErrorException('wrong');
                        $consumer->run($data['data']);
                        $msg->delivery_info['channel']->basic_ack(
                            $msg->delivery_info['delivery_tag']
                        );
                    } catch (Exception $exception) {
                        $msg->delivery_info['channel']->basic_ack(
                            $msg->delivery_info['delivery_tag']
                        );
                    }
                }
            }
        };
    }

    public function receive()
    {
        while (true) {
            if (count($this->channel->callbacks)) {
                $this->channel->wait();
            } else {
                sleep(3);
            }
        }
    }
}
