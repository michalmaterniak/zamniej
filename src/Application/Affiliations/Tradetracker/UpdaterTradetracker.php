<?php

namespace App\Application\Affiliations\Tradetracker;

use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use App\Application\Affiliations\Tradetracker\Api\Programs\ProgramsTradetracker;
use App\Application\Affiliations\Tradetracker\Programs\ProgramsTradetrackerFactory;
use Exception;
use GuzzleHttp\Exception\ConnectException;

class UpdaterTradetracker implements UpdaterAffiliationInterface
{

    public function __construct(
        protected ProgramsTradetracker $programsTradetracker,
        protected ProgramsTradetrackerFactory $programsTradetrackerFactory,
        protected FinderOffersTradetracker $finderOffersTradetracker
    ) {}

    public function update()
    {
        foreach ($this->programsTradetracker->getPrograms() as $program) {
            try {
                $shopAffil = $this->programsTradetrackerFactory->updateProgram($program);
                $this->finderOffersTradetracker->loadOffers($shopAffil);
                dump('[tradetracker] pobrano z ' . $shopAffil->getName());

            } catch (ConnectException $connectException) {
                dump('Nie można pobrać programów z tradetracker');
            } catch (Exception $exception) {
                dump($exception->getMessage());
            }
        }
    }
}
