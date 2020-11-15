<?php
namespace App\Controller\Front\Api;

use App\Application\Sitemap\Sitemap;
use App\Controller\Front\Api\AbstractController as GlobalController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends GlobalController
{
    /**
     * @param Sitemap $sitemap
     * @return JsonResponse
     * @Route("/page/api/sitemap", name="page-api-sitemap", methods={"POST"})
     */
    public function sitemap(Sitemap $sitemap)
    {
        $this->templateVars->insert('urls', $sitemap->getUrls());
        return $this->responseJson();
    }
}
