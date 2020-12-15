<?php
namespace App\Command\Queue;

use App\Services\QueueManager\Producers\TestProducer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueueTestSenderCommand extends Command
{
    protected static $defaultName = 'queue:test-send';

    /**
     * @var TestProducer $testProducer
     */
    protected $testProducer;

    public function __construct(
        TestProducer $testProducer,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->testProducer = $testProducer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Consumers - test sending & retrieve');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        for ($i = 0; $i < 100000; ++$i) {
            $this->testProducer->addToQueue($i);
        }
        return 0;
    }
}
