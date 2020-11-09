<?php
namespace App\Application\SiteWide\Articles;

use App\Application\Pages\Page\Page;
use App\Application\Pages\PagesManager;
use App\Application\SiteWide\FrontInitInterface;
use App\Repository\Repositories\Subpages\Pages\Types\Blog\BlogArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ArticlesSiteWide implements FrontInitInterface
{
    /**
     * @var BlogArticleRepository $blogArticleRepository
     */
    protected $blogArticleRepository;

    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

    public function __construct(
        BlogArticleRepository $blogArticleRepository,
        PagesManager $pagesManager
    )
    {
        $this->pagesManager = $pagesManager;
        $this->blogArticleRepository = $blogArticleRepository;
    }

    /**
     * @param int $count
     * @return array|string[]
     */
    public function getValue(int $count = 2)
    {
        /**
         * @var Page[]|ArrayCollection
         */
        $articlesModels = $this->pagesManager->loadEntities(
            $this->blogArticleRepository->select()->getLatest(2)->getResults()
        );

        $articlesArray = [];
        foreach ($articlesModels as $articleModel) {
            $articlesArray[] = [
                'name' => $articleModel->getSubpage()->getSubpage()->getName(),
                'slug' => $articleModel->getSubpage()->getSlug(),
                'datetimeCreate' => $articleModel->getSubpage()->getSubpage()->getDatetimeCreate(),
            ];
        }

        return $articlesArray;
    }

    public function getName(): string
    {
        return 'latestArticles';
    }
}
