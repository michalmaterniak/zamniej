<?php
namespace App\Application\Pages\Shop\Factory;

use App\Application\Images\ImageManager;
use App\Application\Pages\Shop\Factory\Tags\RandomizerShopsTag;
use App\Application\Pages\Shop\ShopConfig;
use App\Application\QueueManager\Producers\Webepartners\OffersProducer;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Resources;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ShopFactoryAffiliation
 * @package App\Application\Pages\Shop\Factory
 */
class ShopFactoryAffiliation extends ShopFactory
{

    /**
     * @var OffersProducer $offersProducer
     */
    protected $offersProducer;

    public function __construct(
        EntityManagerInterface $entityManager,
        ShopSubpageFactory $subpageFactory,
        ShopConfig $resourceConfig,
        RandomizerShopsTag $randomizerShopsTag,
        ImageManager $imageManager,
        SlugGenerator $slugGenerator,
        OffersProducer $offersProducer
    )
    {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $randomizerShopsTag, $imageManager, $slugGenerator);
        $this->offersProducer = $offersProducer;
    }

    /**
     * @var ShopsAffiliation $program
     */
    protected $program;

    public function afterCreateSubpage(): void
    {
        parent::afterCreateSubpage();
        $this->tieWithShopAffiliation();
    }

    public function afterCommit()
    {
        $this->offersProducer->addToQueue($this->program->getExternalId());
    }

    /**
     * @param ShopsAffiliation $program
     * @param Resources $category
     * @return ShopFactory
     */
    public function createByAffiliate(ShopsAffiliation $program, Resources $category): ShopFactory
    {
        $this->program = $program;
        return $this->create($program->getName(), $category, ['logo' => $program->getUrlLogo()]);
    }

    protected function tieWithShopAffiliation()
    {
        $this->program->setSubpage($this->currentSubpage);
        $this->entityManager->flush();
    }
}
