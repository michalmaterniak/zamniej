<?php
namespace App\Command\Queue;

use App\Services\QueueManager\Producers\KillProducer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueueProcessKillCommand extends Command
{
    protected static $defaultName = 'queue:process-kill';

    /**
     * @var KillProducer $killProducer
     */
    protected $killProducer;

    public function __construct(
        KillProducer $killProducer,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->killProducer = $killProducer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Consumers - kill retrieve process');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->killProducer->addToQueue();
        return 0;
    }
}
