<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 23.04.18
 * Time: 23:01
 */
namespace App\Controller\Admin\Api\System;

use App\Controller\Admin\Api\AbstractController;
use App\Services\System\Cache\CacheManager;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class SystemController extends AbstractController
{

    /**
     * @param CacheManager $cacheSystem
     * @return JsonResponse|RedirectResponse
     * @Route("/admin/api/system/remove-cache", name="admin-api-system-removeCache", methods={"GET"})
     */
    public function removeCache(CacheManager $cacheSystem)
    {
        try {
            $cacheSystem->getCache()->clearCache();

            return $this->redirectToRoute('page-pages-main', [
                //                '_locale' => $this->requestStack->getCurrentRequest()->getLocale(),
                'slug' => '',
            ]);
        } catch (ErrorException $exception) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
    }
}
