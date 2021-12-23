<?php
namespace App\Command;

use App\Application\Affiliations\Tradetracker\Api\Offers\VouchersTradetracker as PromotionsTradetracker ;
use App\Application\Pages\Homepage\Services\UpdatePromotionsHomepage;
use App\Repository\Repositories\Subpages\SubpageOffersRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    public function __construct(protected UpdatePromotionsHomepage $updatePromotionsHomepage, string $name = null)
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
        $this->updatePromotionsHomepage->update();
        return 0;
    }
}
