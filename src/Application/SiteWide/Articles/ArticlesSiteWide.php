<?php
namespace App\Application\SiteWide\Articles;

use App\Application\Components;
use App\Application\Pages\Page\Page;
use App\Application\Pages\Page\Types\Blog\Article\BlogArticle;
use App\Application\SiteWide\FrontInitInterface;
use App\Entity\Entities\Pages\Pages;
use App\Entity\Entities\Subpages\Resources;
use App\Repository\Repositories\Pages\PagesRepository;
use App\Repository\Repositories\Subpages\ResourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class ArticlesSiteWide implements FrontInitInterface
{
    /**
     * @var Components $components
     */
    protected $components;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var BlogArticle $blogArticle
     */
    protected $blogArticle;

    /**
     * ArticlesSiteWide constructor.
     * @param EntityManagerInterface $entityManager
     * @param BlogArticle $blogArticle
     * @param Components $components
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        BlogArticle $blogArticle,
        Components $components
    )
    {
        $this->entityManager = $entityManager;
        $this->components = $components;
        $this->blogArticle = $blogArticle;
    }

    /**
     * @param int $count
     * @return array|string[]
     */
    public function getValue(int $count = 2)
    {
        /**
         * @var ResourcesRepository $pagesRepo
         */
        $pagesRepo = $this->entityManager->getRepository(Resources::class);

        /**
         * @var Page[]|ArrayCollection
         */
        $articlesModels = $this->components->getPageManager()->loadEntities(
            $pagesRepo->select()->findResourcesByType($this->blogArticle->getComponents()->getResourceConfig()->getKey(), $count)->getResults()
        );

        $articlesArray = [];
        foreach ($articlesModels as $articleModel) {
            $articlesArray[] = [
                'name' =>           $articleModel->getSubpage()->getSubpage()->getName(),
                'slug' =>           $articleModel->getSubpage()->getSlug(),
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
