<?php
namespace App\Command;

use App\Application\Affiliations\Convertiser\Api\TrackingUrlConvertiser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    /**
     * @var TrackingUrlConvertiser $trackingUrlConvertiser
     */
    protected $trackingUrlConvertiser;

    public function __construct(TrackingUrlConvertiser $trackingUrlConvertiser, string $name = null)
    {
        parent::__construct($name);
        $this->trackingUrlConvertiser = $trackingUrlConvertiser;
    }

    protected function configure()
    {
        $this
            ->setDescription('test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump($this->trackingUrlConvertiser->getTrackingUrl('36X57NQDxp', '0pxEKW7z6b'));
        return 0;
    }
}
