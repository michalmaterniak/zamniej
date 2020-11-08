<?php
namespace App\Application\Pages\Page\Types\Blog\Article;

use App\Application\Offers\OffersManager;
use App\Application\Pages\Page\PageComponents;
use App\Application\Pages\Page\Types\Blog\Article\Factory\BlogArticleFactory;
use App\Application\Sliders\Slide;
use App\Repository\Repositories\Subpages\Pages\Types\Blog\BlogArticleRepository;
use App\Services\Photos\Photo;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class BlogArticleComponents
 * @package App\Application\Pages\Page\Types\Blog\Article
 */
class BlogArticleComponents extends PageComponents
{
    public function __construct(
        BlogArticleRepository $blogArticleRepository,
        BlogArticleConfig $articleConfig,
        BlogArticleFactory $resourceFactory,
        OffersManager $offersManager,
        Slide $slide,
        Photo $photo,
        RouterInterface $router
    ) {
        parent::__construct($blogArticleRepository, $articleConfig, $resourceFactory, $offersManager, $slide, $photo, $router);
    }
}
