<?php
namespace App\Command\Webepartners;

use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;
use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Application\Affiliations\Webepartners\Programs\ProgramsWebepartnersFactory;
use App\Application\QueueManager\Producers\Webepartners\OffersProducer;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
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
     * @var OffersProducer $offersProducer
     */
    protected $offersProducer;

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var FinderOffersWebepartners $finderOffersWebepartners
     */
    protected $finderOffersWebepartners;

    public function __construct(
        ProgramsWebepartnersFactory $programsWebepartnersFactory,
        ProgramsWebepartners $programsWebepartners,
        OffersProducer $offersProducer,

        FinderOffersWebepartners $finderOffersWebepartners,
        WebepartnersProgramsRepository $webepartnersProgramsRepository,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->programsWebepartnersFactory = $programsWebepartnersFactory;
        $this->programsWebepartners = $programsWebepartners;
        $this->offersProducer = $offersProducer;

        $this->finderOffersWebepartners = $finderOffersWebepartners;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('webepartners_programs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->programsWebepartners->getPrograms() as $program) {
            try {
                $shopAffil = $this->programsWebepartnersFactory->updateProgram($program);
                $this->finderOffersWebepartners->loadOffers($shopAffil);
                dump('pobrano z ' . $shopAffil->getName());

            } catch (ConnectException $connectException) {
                dump('Nie można pobrać programów z webepartners');
            }
        }

        return 0;
    }
}
