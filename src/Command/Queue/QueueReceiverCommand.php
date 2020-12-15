<?php
namespace App\Command\Queue;

use App\Services\QueueManager\ConsumerManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueueReceiverCommand extends Command
{
    protected static $defaultName = 'queue:receiver';

    /**
     * @var ConsumerManager $consumerManager
     */
    protected $consumerManager;

    public function __construct(
        ConsumerManager $consumerManager,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->consumerManager = $consumerManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Consumers');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->consumerManager->receive();
        return 0;
    }
}
