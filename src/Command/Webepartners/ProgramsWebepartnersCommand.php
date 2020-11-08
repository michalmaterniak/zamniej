<?php

namespace App\Command\Webepartners;

use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;
use App\Application\Affiliations\Webepartners\ProgramsFactoryWebepartners;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProgramsWebepartnersCommand extends Command
{
    protected static $defaultName = 'webepartners_programs';

    protected $programsWebepartners;

    /**
     * @var ProgramsFactoryWebepartners $programsFactoryWebepartners
     */
    protected $programsFactoryWebepartners;

    public function __construct(
        ProgramsWebepartners  $programsWebepartners,
        ProgramsFactoryWebepartners $programsFactoryWebepartners,
        string $name = null
    ) {
        parent::__construct($name);
        $this->programsWebepartners = $programsWebepartners;
        $this->programsFactoryWebepartners = $programsFactoryWebepartners;
    }

    protected function configure()
    {
        $this
            ->setDescription('webepartners_programs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $programs = $this->programsWebepartners->getPrograms();
        foreach ($programs as $program) {
            $programEntity = $this->programsFactoryWebepartners->updateProgram($program, true);
        }

        return 0;
    }
}
