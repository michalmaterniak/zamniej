<?php

namespace App\Controller\Admin\Api\Pages\Resource;

use App\Application\Pages\PagesManager;
use App\Entity\Entities\Settings\Settings;
use App\Repository\Repositories\Settings\SettingsRepository;
use App\Services\System\Request\Retrievers\RequestDataManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SeoController extends AbstractResourceController
{
    /**
     * @param PagesManager $pagesManager
     * @param SettingsRepository $settingsRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/admin/api/pages/resource/seo/types", name="admin-api-pages-resource-seo-types", methods={"POST"})
     */
    public function types(PagesManager $pagesManager, SettingsRepository $settingsRepository)
    {
        $this->templateVars->insert('configs', $this->normalizer->normalize($pagesManager->getConfigAllResources()));
        $this->templateVars->insert('settings', $settingsRepository->select()->getByType(Settings::TYPE_SEO)->getResults());

        return $this->responseJson();
    }

    /**
     * @param RequestDataManager $requestDataManager
     * @param SettingsRepository $settingsRepository
     * @return JsonResponse
     * @Route("/admin/api/pages/resource/seo/save", name="admin-api-pages-resource-seo-save", methods={"POST"})
     */
    public function save(
        RequestDataManager $requestDataManager,
        SettingsRepository $settingsRepository
    )
    {
        if ($requestDataManager->checkIfExist('config')) {
            $config = $requestDataManager->getValue('config');
            $setting = $settingsRepository->select()->getOneById($config['setting']['idSetting'])->getResultOrNull();
            $setting->setSettings($config['setting']['settings']);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse([
                'success' => true,
                'message' => 'Zapisano nowe ustawienia SEO dla ' . $config['name']
            ]);
        }

        return new JsonResponse([
            'success' => false,
            'message' => 'Błąd podczas zapisu'
        ]);
    }

}
