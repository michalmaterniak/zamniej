<?php
namespace App\Command\Affiliations;

use App\Application\Affiliations\UpdaterAffiliations;
use App\Application\Pages\Homepage\Services\UpdatePromotionsHomepage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdaterAffiliationsCommand extends Command
{
    protected static $defaultName = 'update_affiliations';

    public function __construct(
        protected UpdaterAffiliations $updaterAffiliations,
        protected UpdatePromotionsHomepage $updatePromotionsHomepage,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Aktualizacja wszystkich firm afiliacyjnych')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->updaterAffiliations->update();
        $this->updatePromotionsHomepage->update();

        return 0;
    }
}
