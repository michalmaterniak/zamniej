<?php

namespace App\Controller\Admin\Api\Pages\Resource;

use App\Application\Pages\PagesManager;
use App\Application\System\Settings\SettingsPage;
use Symfony\Component\Routing\Annotation\Route;

class TypesController extends AbstractResourceController
{
    /**
     * @param PagesManager $pagesManager
     * @param SettingsPage $settingPage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/admin/api/pages/resource/types", name="admin-api-pages-types", methods={"POST"})
     */
    public function types(PagesManager $pagesManager, SettingsPage $settingPage)
    {
        $settings = $settingPage->getSettings();
        return $this->json($this->normalizer->normalize($pagesManager->getConfigAllResources()), 200);
    }
}
