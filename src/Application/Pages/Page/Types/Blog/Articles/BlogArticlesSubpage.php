<?php
namespace App\Application\Pages\Page\Types\Blog\Articles;

use App\Application\Pages\Page\PageSubpage;
use App\Application\Pages\Page\Types\Blog\Article\BlogArticle;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class BlogArticlesSubpage
 * @package App\Application\Pages\Page\Types\Blog\Articles
 * @method BlogArticlesComponents getComponents() : BlogArticlesComponents
 */
class BlogArticlesSubpage extends PageSubpage
{
    /**
     * @var int $articlesPerPage
     */
    private $articlesPerPage = 10;

    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * @var int
     */
    private $countArticles;

    public function __construct(
        BlogArticlesComponents $components
    )
    {
        parent::__construct($components);
    }

    /**
     * @return BlogArticle[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getArticles()
    {
        if (!$this->articles) {
            $this->articles = new ArrayCollection();
            $articles = $this->getComponents()->getBlogArticleRepository()->select()->findAllPerPageMax($this->articlesPerPage)->getPaginate();
            $articlesModels = $this->getComponents()->getResourcesManager()->loadBlogArticles(
                $articles
            );

            foreach ($articlesModels as $articleModel) {
                $this->articles->add([
                    'slug' => $articleModel->getSubpage()->getSlug(),
                    'header' => $articleModel->getSubpage()->getPhoto()->getModifiedPhoto('fit', 370, 245),
                    'name' => $articleModel->getSubpage()->getSubpage()->getName(),
                    'content' => $articleModel->getSubpage()->getContent(),
                    'create' => $articleModel->getSubpage()->getSubpage()->getDatetimeCreate()
                ]);
            }
            $this->countArticles = $articles->count();
        }

        return [
            'articles' => $this->articles,
            'count' => $this->countArticles,
            'perPage' => $this->articlesPerPage,
            'currentCount' => $this->articles->count(),
        ];
    }

    /**
     * @return int
     * @Groups({"resource"})
     */
    public function getCountArticles()
    {
        $this->getArticles();
        return $this->countArticles;
    }
}
