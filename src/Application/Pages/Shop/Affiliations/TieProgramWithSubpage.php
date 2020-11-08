<?php
namespace App\Application\Pages\Shop\Affiliations;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Repositories\Subpages\SubpagesRepository;
use Doctrine\ORM\EntityManagerInterface;

class TieProgramWithSubpage
{
    /**
     * @var ShopsAffiliationRepository $shopsAffiliationRepository
     */
    protected $shopsAffiliationRepository;

    /**
     * @var SubpagesRepository $subpageRepository
     */
    protected $subpageRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var ShopsAffiliation $shopAffiliation
     */
    protected $shopAffiliation;

    /**
     * @var Subpages $shopsSubpage
     */
    protected $shopsSubpage;

    public function __construct(
        ShopsAffiliationRepository  $shopsAffiliationRepository,
        SubpagesRepository $subpagesRepository,
        EntityManagerInterface  $entityManager
    ) {
        $this->subpageRepository = $subpagesRepository;
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param ShopsAffiliation|int $shopAffiliation
     */
    public function setShopAffiliation($shopAffiliation): void
    {

        if (is_numeric($shopAffiliation)) {
            $this->shopAffiliation = $this->shopsAffiliationRepository->find($shopAffiliation);
        } elseif ($shopAffiliation instanceof ShopsAffiliation) {
            $this->shopAffiliation = $shopAffiliation;
        }
    }

    /**
     * @param Subpages|int $shopsSubpage
     */
    public function setShopsSubpage($shopsSubpage): void
    {
        if (is_numeric($shopsSubpage)) {
            $this->shopsSubpage = $this->subpageRepository->find($shopsSubpage);
        } elseif ($shopsSubpage instanceof Subpages) {
            $this->shopsSubpage = $shopsSubpage;
        }
    }
    public function tie()
    {
        if ($this->shopsSubpage && $this->shopAffiliation) {
            $this->shopAffiliation->setIsNew(false);
            $this->shopAffiliation->setSubpage($this->shopsSubpage);
            $this->entityManager->flush();
        } else {
            throw new \ErrorException('Podstrona i Program Afiliacyjny muszą zostac zdefiniowane');
        }
    }
}
