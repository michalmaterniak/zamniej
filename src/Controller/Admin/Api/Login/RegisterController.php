<?php
namespace App\Controller\Admin\Api\Login;

use App\Controller\Admin\Api\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route("/admin/api/auth/register/setting/enable", name="admin-api-auth-register-setting-enable", methods={"GET"})
     */
    public function enable()
    {
        try {
            return new JsonResponse([
                'enable' => true,
                'success' => true,
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
    }
}
