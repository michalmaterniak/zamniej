<?php
namespace App\Application\Pages\Page\Types\Blog\Articles;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\PageComponents;
use App\Application\Pages\Page\Types\Blog\Articles\Factory\BlogArticlesFactory;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\Types\Blog\BlogArticleRepository;
use App\Repository\Repositories\Subpages\Pages\Types\Blog\BlogArticlesRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class BlogArticlesComponents
 * @package App\Application\Pages\Page\Types\Blog\Articlesv
 * @method BlogArticlesRepository getCustomRepository() : BlogArticlesRepository
 */
class BlogArticlesComponents extends PageComponents
{

    /**
     * @var BlogArticleRepository $blogArticleRepository
     */
    protected $blogArticleRepository;

    public function __construct(
        BlogArticleRepository $blogArticleRepository,
        BlogArticlesRepository $blogArticlesRepository,
        BlogArticlesConfig $resourceConfig,
        BlogArticlesFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    )
    {
        parent::__construct($blogArticlesRepository, $resourceConfig, $resourceFactory, $offersManager, $slide, $photo, $router);
        $this->blogArticleRepository = $blogArticleRepository;
    }

    /**
     * @return BlogArticleRepository
     */
    public function getBlogArticleRepository(): BlogArticleRepository
    {
        return $this->blogArticleRepository;
    }
}
