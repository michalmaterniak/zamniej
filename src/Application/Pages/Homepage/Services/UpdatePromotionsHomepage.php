<?php

namespace App\Application\Pages\Homepage\Services;

use App\Application\Offers\OffersManager;
use App\Application\Pages\PagesManager;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use App\Entity\Entities\Subpages\SubpageOffers;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Repository\Repositories\Subpages\Pages\HomepageRepository;
use App\Repository\Repositories\Subpages\SubpageOffersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class UpdatePromotionsHomepage
{
    /**
     * @var Subpages $homepageSubpage
     */
    protected $homepageSubpage;

    protected $countPromotion = 16;

    /**
     * @var ArrayCollection|Subpages[]
     */
    protected ArrayCollection $subpageUsed;

    public function __construct(
        protected HomepageRepository $homepageRepository,
        protected PagesManager $pagesManager,
        protected SubpageOffersRepository $subpageOffersRepository,
        protected EntityManagerInterface $entityManager,
        protected OffersRepository $offersRepository,
        protected OffersManager $offersManager
    )
    {
        $this->subpageUsed = new ArrayCollection();
    }

    protected function setSubpageHomepage() {
        $this->homepageSubpage = $this->pagesManager->loadEntity($this->homepageRepository->select()->getResultOrNull())->getSubpage()->getSubpage();
    }

    /**
     * @return SubpageOffers[]|ArrayCollection
     */
    protected function getActualOffer() {
        return $this->subpageOffersRepository->select()->findBySubpage($this->homepageSubpage)->getResults();
    }

    protected function clearAll() {
        foreach ($this->getActualOffer() as $offer) {
            $this->entityManager->remove($offer);
        }
    }

    public function update() {
        $this->setSubpageHomepage();

        $this->clearAll();
        for($i = 0; $i < $this->countPromotion; ++$i) {
            $offer = $this->offersRepository->select()
                ->getTypeOffer(OffersPromotion::class)
                ->excludeSubpages($this->subpageUsed)
                ->listingHomepage()
                ->getLast()
                ->getResultOrNull();

            if (!$offer) {
                continue;
            }
            $this->subpageUsed->add($offer->getSubpage());
            $newSubpageOffer = new SubpageOffers();
            $newSubpageOffer->setSubpage($this->homepageSubpage);
            $newSubpageOffer->setOffer($offer);
            $newSubpageOffer->setType('promotion');
            $this->entityManager->persist($newSubpageOffer);
            $this->entityManager->flush();
        }
        for($i = 0; $i < $this->countPromotion; ++$i) {
            $offer = $this->offersRepository->select()->getTypeOffer(OffersVoucher::class)->withSubpage()->excludeSubpages($this->subpageUsed)->getLast()->getResultOrNull();
            $this->subpageUsed->add($offer->getSubpage());
            $newSubpageOffer = new SubpageOffers();
            $newSubpageOffer->setSubpage($this->homepageSubpage);
            $newSubpageOffer->setOffer($offer);
            $newSubpageOffer->setType('voucher');
            $this->entityManager->persist($newSubpageOffer);
            $this->entityManager->flush();
        }
    }
}
