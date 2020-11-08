<?php
namespace App\Controller\Front\Api\Pages\Blog;

use App\Application\Pages\Page\Page;
use App\Application\Pages\Page\Types\Blog\Articles\BlogArticles;
use App\Controller\Front\Api\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ArticlesController extends AbstractController
{
    /**
     * @param Page $page
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function articles(Page $page)
    {
        $articles = $page->getSubpage()->getArticles();
        $this->templateVars->insert('articles', $this->normalizer->normalize($articles, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }

    public function index(BlogArticles $page)
    {
        $status = 200;
        if ($page->getSubpage()->getCountArticles() === 0) {
            $status = 404;
        }
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson($status);
    }
}
