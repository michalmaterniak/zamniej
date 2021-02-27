<?php

namespace App\Application\Affiliations\Webepartners;

use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use App\Application\Affiliations\Webepartners\Api\Programs\ProgramsWebepartners;
use App\Application\Affiliations\Webepartners\Programs\ProgramsWebepartnersFactory;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        ProgramsWebepartnersFactory $programsWebepartnersFactory,
        ProgramsWebepartners $programsWebepartners,

        FinderOffersWebepartners $finderOffersWebepartners
    )
    {
        $this->programsWebepartnersFactory = $programsWebepartnersFactory;
        $this->programsWebepartners = $programsWebepartners;
        $this->finderOffersWebepartners = $finderOffersWebepartners;

        $this->entityManager = $entityManager;
    }

    public function update()
    {
        foreach ($this->programsWebepartners->getPrograms() as $program) {
            try {
                $shopAffil = $this->programsWebepartnersFactory->updateProgram($program);

                if($shopAffil->hasSubpage()) {
                    $shopAffil->getSubpage()->setActive(
                        $shopAffil->isEnable()
                    );

                    $this->entityManager->flush();
                }

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
