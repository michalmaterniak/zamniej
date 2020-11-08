<?php
namespace App\DataFixtures\Pages;

use App\Application\Images\ImageManager;
use App\Application\Pages\Page\Types\Blog\Article\Factory\BlogArticleFactory;
use App\Application\Pages\Page\Types\Blog\Articles\BlogArticles;
use App\Application\Pages\PagesManager;
use App\DataFixtures\Settings\SettingsFixture;
use Doctrine\ORM\EntityManagerInterface;

class BlogFixtures extends AbstractPageFixtures
{
    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    /**
     * @var BlogArticleFactory $blogArticleFactory
     */
    protected $blogArticleFactory;

    /**
     * @var BlogArticles $blogArticlesModel
     */
    protected $blogArticlesModel;

    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    public function __construct(
        SettingsFixture         $settingsFixture,
        EntityManagerInterface  $entityManager,
        PagesManager            $modelPagesManager,
        BlogArticleFactory      $blogArticleFactory,
        ImageManager            $imageManager
    ) {
        parent::__construct($entityManager, $settingsFixture, $modelPagesManager);
        $this->blogArticleFactory = $blogArticleFactory;
        $this->imageManager = $imageManager;
    }

    public function load()
    {
        $this->blogArticlesModel = static::getFixture('blog-articles');

//        for ($i = 1; $i <= 24; ++$i) {
//            $this->createArticle($this->fakerPl->sentence(8));
//        }

        $this->settingsFixutres->createSeoSetting('Pages-Blog-Article');
    }

    protected function createArticle(string $name)
    {
        do {
            $rand = rand(1, 300);
            $urlImg = "https://picsum.photos/id/".$rand."/1600/1200";
            $path = $this->imageManager->saveTmp($urlImg, 'header');
            if ($path) {
                break;
            }
        } while (true);

        $facory = $this->blogArticleFactory->create($name, $this->blogArticlesModel->getModelEntity(), ['header' => $path]);
        $page = $facory->getPageCreate();
        foreach ($page->getResource()->getSubpages() as $key => $subpage) {
            $this->fakeContent($subpage->getContent(), $key);
        }

        $facory->save();

        dump('      created article: '.$subpage->getIdSubpage());
    }
}
