<?php
namespace App\Command\Webepartners;

use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;
use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Application\Affiliations\Webepartners\Programs\ProgramsWebepartnersFactory;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProgramsWebepartnersCommand extends Command
{
    protected static $defaultName = 'webepartners_programs';

    /**
     * @var ProgramsWebepartnersFactory $programsWebepartnersFactory
     */
    protected $programsWebepartnersFactory;

    /**
     * @var ProgramsWebepartners $programsWebepartners
     */
    protected $programsWebepartners;

    /**
     * @var FinderOffersWebepartners $finderOffersWebepartners
     */
    protected $finderOffersWebepartners;

    public function __construct(
        ProgramsWebepartnersFactory $programsWebepartnersFactory,
        ProgramsWebepartners $programsWebepartners,
        FinderOffersWebepartners $finderOffersWebepartners,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->programsWebepartnersFactory = $programsWebepartnersFactory;
        $this->programsWebepartners = $programsWebepartners;
        $this->finderOffersWebepartners = $finderOffersWebepartners;
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
            foreach ($this->programsWebepartners->getPrograms() as $program) {
                $shopAffil = $this->programsWebepartnersFactory->updateProgram($program);
            }

        } catch (ConnectException $connectException) {
            dump('Nie można pobrać programów z webepartners');
        }

        return 0;
    }
}
