<?php

namespace App\Application\Affiliations\Webepartners;

use App\Application\Affiliations\Interfaces\FinderProgramsInterface;
use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;

class FinderProgramsWebepartners implements FinderProgramsInterface
{
    /**
     * @var ProgramsWebepartners $programsWebepartners
     */
    protected $programsWebepartners;

    /**
     * @var ProgramsWebepartnersFactory $programsWebepartnersFactory
     */
    protected $programsWebepartnersFactory;

    public function __construct(
        ProgramsWebepartners $programsWebepartners,
        ProgramsWebepartnersFactory $programsWebepartnersFactory
    )
    {
        $this->programsWebepartners = $programsWebepartners;
        $this->programsWebepartnersFactory = $programsWebepartnersFactory;
    }

    public function find()
    {
        $programs = $this->programsWebepartners->getPrograms();
        foreach ($programs as $program) {
            $this->programsWebepartnersFactory->updateProgram($program);
        }
    }
}
