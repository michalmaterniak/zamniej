<?php
namespace App\Application\Pages\Shop\Factory;

use App\Application\Images\ImageManager;
use App\Application\Pages\Shop\Factory\Tags\RandomizerShopsTag;
use App\Application\Pages\Shop\ShopConfig;
use App\Application\QueueManager\Producers\Webepartners\OffersProducer;
use App\Entity\Entities\Shops\Shops;
use App\Entity\Entities\System\Files;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CreateShop
 * @package App\Services\Subpages\Factory\Resources
 */
class ShopFactory extends ResourceFactory
{
    /**
     * @var Shops $pageCreate
     */
    protected $pageCreate;

    /**
     * @var RandomizerShopsTag $randomizerShopsTag
     */
    protected $randomizerShopsTag;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

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
        SlugGenerator $slugGenerator
    )
    {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
        $this->randomizerShopsTag = $randomizerShopsTag;
        $this->imageManager = $imageManager;
    }

    public function beforeCreatePage(): void
    {
        $this->pageCreate->setTag($this->randomizerShopsTag->random());
    }

    public function afterCreateSubpage(): void
    {
        if (!empty($this->data['logo'])) {
            $this->createLogo();
        } else {
            $photo = $this->createEmptyPhoto('logo');
            $this->currentSubpage->addFile($photo);
            $this->entityManager->flush();
        }
    }

    protected function createLogo()
    {
        $logo = new Files();
        $logo->setData('Logo ' . $this->currentSubpage->getName(), 'alt');
        $logo->setGroup('logo');
        $pathHeader = $this->imageManager->saveAsSubpage($this->currentSubpage, $this->data['logo'], 'logo');
        $logo->setPath($pathHeader);
        $this->entityManager->persist($logo);
        $this->currentSubpage->addFile($logo);
        $this->entityManager->flush();
    }
}
