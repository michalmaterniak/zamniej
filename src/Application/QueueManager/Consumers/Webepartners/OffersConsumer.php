<?php
namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\QueueManager\Interfaces\Consumer;

class OffersConsumer implements Consumer
{
    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var FinderOffersWebepartners $finderOffersWebepartners
     */
    protected $finderOffersWebepartners;

    public function __construct(
        FinderOffersWebepartners $finderOffersWebepartners,
        WebepartnersProgramsRepository $webepartnersProgramsRepository
    )
    {
        $this->finderOffersWebepartners = $finderOffersWebepartners;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
    }

    public function run(array $data = []): void
    {
        if ($program = $this->webepartnersProgramsRepository->select()->getProgramByWebeId($data['externalId'])->getResultOrNull()) {
            $this->finderOffersWebepartners->loadOffers($program);
            dump('pobrano z ' . $program->getName());
        } else {
            dump("nie znaleziono progrmau o zewnętrzyn id: {$data['externalId']}");
        }
    }
}
