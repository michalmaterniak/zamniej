<?php
namespace App\Command;

use App\Application\Affiliations\Convertiser\Api\Offers\OfferTrackingUrlConvertiser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    /**
     * @var OfferTrackingUrlConvertiser $programsConvertiser
     */
    protected $programsConvertiser;

    public function __construct(OfferTrackingUrlConvertiser $programsConvertiser, string $name = null)
    {
        parent::__construct($name);
        $this->programsConvertiser = $programsConvertiser;
    }

    protected function configure()
    {
        $this
            ->setDescription('test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump($this->programsConvertiser->getOfferTrackingUrl(499, "0pxEKW7z6b"));
        return 0;
    }
}
