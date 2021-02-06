<?php

namespace App\Application\Affiliations\Convertiser;

use App\Application\Affiliations\Convertiser\Api\Programs\ProgramsConvertiser;
use App\Application\Affiliations\Convertiser\Programs\ProgramsConvertiserFactory;
use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class UpdaterConvertiser implements UpdaterAffiliationInterface
{

    /**
     * @var ProgramsConvertiserFactory $programsWebepartnersFactory
     */
    protected $programsConvertiserFactory;

    /**
     * @var ProgramsConvertiser $programsConvertiser
     */
    protected $programsConvertiser;

    public function __construct(
        ProgramsConvertiser $programsConvertiser,
        ProgramsConvertiserFactory $programsConvertiserFactory
    )
    {
        $this->programsConvertiser = $programsConvertiser;
        $this->programsConvertiserFactory = $programsConvertiserFactory;
    }

    public function update()
    {
        foreach ($this->programsConvertiser->getPrograms() as $program) {
            try {
                $shopAffil = $this->programsConvertiserFactory->updateProgram($program);
                // loadOffers
                dump('[convertiser] pobrano z ' . $shopAffil->getName());

            } catch (ConnectException $connectException) {
                dump('Nie można pobrać programów z convertiser');
            } catch (Exception $exception) {
                dump($exception->getMessage());
            }
        }
    }
}
