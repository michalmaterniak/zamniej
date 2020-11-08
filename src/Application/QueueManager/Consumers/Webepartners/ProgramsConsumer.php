<?php
namespace App\Application\QueueManager\Consumers\Webepartners;

use App\Application\Affiliations\Webepartners\ProgramsFactoryWebepartners;
use App\Services\QueueManager\Interfaces\Consumer;

class ProgramsConsumer implements Consumer
{
    /**
     * @var ProgramsFactoryWebepartners $programsFactoryWebepartners
     */
    protected $programsFactoryWebepartners;

    public function __construct(
        ProgramsFactoryWebepartners $programsFactoryWebepartners
    ) {
        $this->programsFactoryWebepartners = $programsFactoryWebepartners;
    }

    public function run(array $data) : void
    {
        $this->programsFactoryWebepartners->saveProgram($data['program']);
    }
}
