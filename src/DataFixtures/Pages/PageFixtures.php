<?php
namespace App\DataFixtures\Pages;

use App\Application\Pages\Homepage\Factory\HomepageChildResourceFactory;
use App\Application\Pages\Homepage\Homepage;
use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\Types\Blog\Articles\BlogArticles;
use App\Application\Pages\Page\Types\Categories\Categories;
use App\Application\Pages\Page\Types\Promotions\Promotions;
use App\Application\Pages\Page\Types\Shops\Shops;
use App\DataFixtures\Settings\SettingsFixture;
use App\Application\Pages\PagesManager;
use Doctrine\ORM\EntityManagerInterface;

class PageFixtures extends AbstractPageFixtures
{
    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    /**
     * @var HomepageChildResourceFactory $homepageChildResourceFactory
     */
    protected $homepageChildResourceFactory;

    /**
     * @var Homepage $homepageModel
     */
    protected $homepageModel;

    public function __construct(
        SettingsFixture                 $settingsFixture,
        EntityManagerInterface          $entityManager,
        PagesManager                    $modelPagesManager,
        HomepageChildResourceFactory    $homepageChildResourceFactory
    ) {
        parent::__construct($entityManager, $settingsFixture, $modelPagesManager);
        $this->homepageChildResourceFactory = $homepageChildResourceFactory;
    }
    public function load()
    {
        $this->homepageModel = static::getFixture('homepage');

//        $this->createAbout();
        $this->createPromotions();
        $this->createShops();
        $this->createCategories();
        $this->createBlogArticles();
    }
    protected function createAbout()
    {

//        /**
//         * @var CreatePage $createPage
//         */
//        $createPage = $this->homepageModel->createChild('O nas');
//        $createPage->addSubpage('pl', 'O nas');
//
//        $pageAbout = $createPage->getResource();
//
//        $pageAbout->getDetails()->setTypeResource(2);
//        $pageAbout->getDetails()->setChildTypeResource(2);
//        $pageAbout->getAdmin()->setFinal(true);
//        $pageAbout->getAdmin()->setUnactivable(false);
//        $pageAbout->getAdmin()->setRemovable(false);
//
//        $createPage->flush();
//        $this->settingsFixutres->createSeoSetting('Pages-About-About');
//        dump('created about');
    }
    protected function createPromotions()
    {
        $factory = $this->homepageChildResourceFactory->createHomepageChild("Promocje", $this->homepageModel, Promotions::class);
        $promotions = $this->modelPagesManager->loadEntity($factory->getPageCreate()->getResource());
        $this->settingsFixutres->createSeoSetting($promotions->getComponents()->getResourceConfig()->getTypeName());
        dump('created promotions');
    }

    protected function createShops()
    {
        $factory = $this->homepageChildResourceFactory->createHomepageChild("Sklepy", $this->homepageModel, Shops::class);
        $promotions = $this->modelPagesManager->loadEntity($factory->getPageCreate()->getResource());
        $this->settingsFixutres->createSeoSetting($promotions->getComponents()->getResourceConfig()->getTypeName());
        dump('created shops');
    }
    protected function createCategories()
    {
        $factory = $this->homepageChildResourceFactory->createHomepageChild("Kategorie", $this->homepageModel, Categories::class);
        $categories = $this->modelPagesManager->loadEntity($factory->getPageCreate()->getResource());
        $this->settingsFixutres->createSeoSetting($categories->getComponents()->getResourceConfig()->getTypeName());
        static::addFixture($categories, 'categories');
        dump('created categories');
    }
    protected function createBlogArticles()
    {
        $factory = $this->homepageChildResourceFactory->createHomepageChild("Blog", $this->homepageModel, BlogArticles::class);
        $categories = $this->modelPagesManager->loadEntity($factory->getPageCreate()->getResource());
        $this->settingsFixutres->createSeoSetting($categories->getComponents()->getResourceConfig()->getTypeName());
        static::addFixture($categories, 'blog-articles');
        dump('created blog articles');
    }
}
