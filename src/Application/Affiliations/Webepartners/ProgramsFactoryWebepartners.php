<?php
namespace App\Application\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProgramsFactoryWebepartners
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var bool $persist
     */
    protected $persist = false;

    /**
     * @var Affiliations $affiliation
     */
    protected $affiliation;

    /**
     * @var AffiliationsRepository $affiliationsRepository
     */
    protected $affiliationsRepository;

    /**
     * @var OffersFactoryWebepartners $offersFactoryWebepartners
     */
    protected $offersFactoryWebepartners;

    public function __construct(
        EntityManagerInterface $entityManager,
        WebepartnersProgramsRepository  $webepartnersProgramsRepository,
        AffiliationsRepository $affiliationsRepository,
        OffersFactoryWebepartners  $offersFactoryWebepartners
    ) {
        $this->entityManager = $entityManager;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
        $this->affiliationsRepository = $affiliationsRepository;
        $this->offersFactoryWebepartners = $offersFactoryWebepartners;
    }

    /**
     * @param array $webeProgram
     * @param false $withOffers
     * @return WebepartnersPrograms
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateProgram(array $webeProgram, $withOffers = false) : WebepartnersPrograms
    {
        $this->affiliation = $this->affiliationsRepository->select()->findOneByName('webepartners')->getResultOrNull();

        $program = $this->webepartnersProgramsRepository->select(false)->getProgramByWebeId($webeProgram['programId'])->getResultOrNull();

        if ($program == null) {
            $program = $this->createProgram();
        }


        foreach ($webeProgram as $key => $value) {
            $method = 'set'.ucfirst($key);
            $program->$method($value);
        }

        if ($this->persist) {
            $this->entityManager->persist($program);
        }
//        if($program->isEnable() && !$program->getSubpage())
//        {
//            $shop = $this->shopFactory->createShopByAffiliate($program, $program->getName(), $this->tmpCategory);
//            $program->setSubpage($shop->getSubpage('pl'));
//        }
        $this->entityManager->flush();

        if ($withOffers && $program->isEnable() && $program->getSubpage()) {
            $this->offersFactoryWebepartners->findOffers($program);
        }

        return $program;
    }

    /**
     * @return WebepartnersPrograms
     */
    public function createProgram()
    {
        $program = new WebepartnersPrograms();
        $this->persist = true;
        $program->setAffiliation($this->affiliation);

        return $program;
    }
}
