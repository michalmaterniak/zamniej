<?php
namespace App\Command;

use App\Application\Affiliations\Tradetracker\Api\Offers\VouchersTradetracker as PromotionsTradetracker ;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    public function __construct(protected PromotionsTradetracker $offersTradetracker, string $name = null)
    {
        parent::__construct($name);

    }

    protected function configure()
    {
        $this
            ->setDescription('test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $offers = $this->offersTradetracker->getPromotions();
        dump($offers);
        dump(count($offers));
        return 0;
    }
}
