<?php
namespace App\Command;

use App\Application\LinkingInternal\GSCIndexes\GSCIndexesUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    /**
     * @var GSCIndexesUpdater $linksGenerator
     */
    protected GSCIndexesUpdater $linksGenerator;

    public function __construct(GSCIndexesUpdater $linksGenerator, string $name = null)
    {
        parent::__construct($name);
        $this->linksGenerator = $linksGenerator;
    }

    protected function configure()
    {
        $this
            ->setDescription('test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->linksGenerator->update();
        return 0;
    }
}
