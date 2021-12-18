<?php
namespace App\Application\Admin\ConfigAdmin;

use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Doctrine\Common\Collections\ArrayCollection;

class FindNewPrograms
{
    /**
     * @var ShopsAffiliation $shopsAffiliation
     */
    protected $shopsAffiliationRepository;

    /**
     * @var ArrayCollection|ShopsAffiliation[] $shops
     */
    protected $shops;

    public function __construct(
        ShopsAffiliationRepository $shopsAffiliationRepository
    )
    {
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
    }

    /**
     * @return array|int[]
     */
    public function getNewProgramsAffiliations()
    {
        $this->shops = $this->shopsAffiliationRepository->select()->getNewPrograms()->getEnablePrograms()->getResults();

        return [
            'total' => $this->shops->count(),
            'webepartners' => $this->extractWebepartners(),
            'tradetracker' => $this->extractTradetracker(),
            'convertiser' => $this->extractConvertiser()
        ];
    }

    /**
     * @return int
     */
    protected function extractWebepartners(): int
    {
        $counter = 0;

        foreach ($this->shops as $shop) {
            $counter = ($shop instanceof WebepartnersPrograms) ? $counter + 1 : $counter;
        }

        return $counter;
    }
    /**
     * @return int
     */
    protected function extractTradetracker(): int
    {
        $counter = 0;

        foreach ($this->shops as $shop) {
            $counter = ($shop instanceof TradetrackerPrograms) ? $counter + 1 : $counter;
        }

        return $counter;
    }

    /**
     * @return int
     */
    protected function extractConvertiser(): int
    {
        $counter = 0;

        foreach ($this->shops as $shop) {
            $counter = ($shop instanceof ConvertiserPrograms) ? $counter + 1 : $counter;
        }

        return $counter;
    }
}
