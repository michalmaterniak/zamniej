<?php
namespace App\DataFixtures\Pages;

use App\Application\Pages\Homepage\Factory\HomepageFactory;
use App\Application\Pages\PagesManager;
use App\DataFixtures\Settings\SettingsFixture;
use App\Application\Pages\Homepage\Homepage;
use Doctrine\ORM\EntityManagerInterface;

class HomepageFixtures extends AbstractPageFixtures
{
    /**
     * @var Homepage $homepageModel
     */
    protected $homepageModel;

    /**
     * @var HomepageFactory $homepageFactory
     */
    protected $homepageFactory;

    public function __construct(
        SettingsFixture             $settingsFixture,
        EntityManagerInterface      $entityManager,
        Homepage                    $homepageModel,
        HomepageFactory             $homepageFactory,
        PagesManager                $modelPagesManager
    ) {
        parent::__construct($entityManager, $settingsFixture, $modelPagesManager);
        $this->homepageModel = $homepageModel;
        $this->homepageFactory = $homepageFactory;
    }

    public function load()
    {
        $homepageFactory = $this->homepageFactory->createHomepage();
        $homepageModel = $this->modelPagesManager->loadEntity($homepageFactory->getHomepage()->getResource());
        $this->settingsFixutres->createSeoSetting($homepageModel->getComponents()->getResourceConfig()->getTypeName());
        static::addFixture($homepageModel, 'homepage');
        dump('created homepage');
    }
}
