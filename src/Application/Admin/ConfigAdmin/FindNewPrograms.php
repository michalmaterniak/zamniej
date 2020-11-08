<?php
namespace App\Application\Admin\ConfigAdmin;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Doctrine\Common\Collections\ArrayCollection;

class FindNewPrograms
{
    /**
     * @var ShopsAffiliation $shopsAffiliation
     */
    protected $shopsAffiliationRepository;
    public function __construct(
        ShopsAffiliationRepository  $shopsAffiliationRepository
    ) {
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
    }

    /**
     * @return int
     */
    public function getNewProgramsAffiliations()
    {
        return $this->shopsAffiliationRepository->counting()->getNewPrograms()->getCount();
    }
}
