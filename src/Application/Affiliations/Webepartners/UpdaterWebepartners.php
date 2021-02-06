<?php

namespace App\Application\Affiliations\Webepartners;

use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;
use App\Application\Affiliations\Webepartners\Programs\ProgramsWebepartnersFactory;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class UpdaterWebepartners implements UpdaterAffiliationInterface
{

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

        FinderOffersWebepartners $finderOffersWebepartners
    )
    {
        $this->programsWebepartnersFactory = $programsWebepartnersFactory;
        $this->programsWebepartners = $programsWebepartners;
        $this->finderOffersWebepartners = $finderOffersWebepartners;
    }

    public function update()
    {
        foreach ($this->programsWebepartners->getPrograms() as $program) {
            try {
                $shopAffil = $this->programsWebepartnersFactory->updateProgram($program);
                $this->finderOffersWebepartners->loadOffers($shopAffil);
                dump('[webepartners] pobrano z ' . $shopAffil->getName());

            } catch (ConnectException $connectException) {
                dump('Nie można pobrać programów z webepartners');
            } catch (Exception $exception) {
                dump($exception->getMessage());
            }
        }
    }
}
