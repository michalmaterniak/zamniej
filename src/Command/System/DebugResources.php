<?php
namespace App\Command\System;

use App\Application\Pages\PagesManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugResources extends Command
{
    protected static $defaultName = 'debug:resources';

    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

    public function __construct(PagesManager $pagesManager, string $name = null)
    {
        parent::__construct($name);
        $this->pagesManager = $pagesManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Show resource\'s config')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new OutputFormatterStyle('magenta', 'default', ['bold', 'blink']);
        $output->getFormatter()->setStyle('fire', $outputStyle);


        $output->writeln('');
        $output->writeln('------------------------------------------');
        $output->writeln('');
        foreach ($this->pagesManager->getResources() as $resource) {
            $output->writeln("<fire>{$resource->getComponents()->getResourceConfig()->getName()}:</fire>");
            $output->writeln("<info>Key</info>:\t\t{$resource->getComponents()->getResourceConfig()->getKey()}");
            $output->writeln("<info>Model</info>:\t\t{$resource->getComponents()->getResourceConfig()->getModelClass()}");
            $output->writeln("<info>Type Entity</info>:\t{$resource->getComponents()->getResourceConfig()->getEntityClass()}");
            $output->writeln("<info>Controller</info>:\t{$resource->getComponents()->getResourceConfig()->getController()}");
            $output->write("<info>Child Key</info>:\t");
            foreach ($resource->getComponents()->getResourceConfig()->getAvailableTypesChildren() as $availableTypeChild) {
                $output->write("{$this->pagesManager->getResourceModel($availableTypeChild)->getComponents()->getResourceConfig()->getKey()}, ");
            }
            $output->writeln('');

            $output->writeln('----------------------------------------------------------------------------------------');
            $output->writeln('');
        }

        return 0;
    }
}
