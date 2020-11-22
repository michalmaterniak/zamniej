<?php
namespace App\Command\Webepartners;

use App\Application\Affiliations\Webepartners\FinderProgramsWebepartners;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProgramsWebepartnersCommand extends Command
{
    protected static $defaultName = 'webepartners_programs';

    /**
     * @var FinderProgramsWebepartners $finderProgramsWebepartners
     */
    protected $finderProgramsWebepartners;

    public function __construct(
        FinderProgramsWebepartners $finderProgramsWebepartners,
        string $name = null
    ) {
        parent::__construct($name);
        $this->finderProgramsWebepartners = $finderProgramsWebepartners;
    }

    protected function configure()
    {
        $this
            ->setDescription('webepartners_programs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->finderProgramsWebepartners->findPrograms();
        } catch (ConnectException $connectException) {
            dump('Nie można pobrać programów z webepartners');
        }

        return 0;
    }
}
