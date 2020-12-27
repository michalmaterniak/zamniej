<?php
namespace App\Command\Webepartners;

use App\Application\Affiliations\UpdaterAffiliations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdaterAffiliationsCommand extends Command
{
    protected static $defaultName = 'update_affiliations';

    /**
     * @var UpdaterAffiliations $updaterAffiliations
     */
    protected $updaterAffiliations;

    public function __construct(
        UpdaterAffiliations $updaterAffiliations,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->updaterAffiliations = $updaterAffiliations;
    }

    protected function configure()
    {
        $this
            ->setDescription('webepartners_programs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->updaterAffiliations->update();

        return 0;
    }
}
