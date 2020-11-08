<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 23.04.18
 * Time: 23:01
 */
namespace App\Controller\Admin\Api\Login;

use App\Application\Admin\ConfigAdministration;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Users\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class AuthController
 * @package App\Controller\Admin\Api\Login
 */
class AuthController extends AbstractController
{

    /**
     * @param RequestStack         $requestStack
     * @param ConfigAdministration $configAdministration
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/auth/check", name="admin-api-auth-check", methods={"POST"})
     */
    public function check(
        TokenStorageInterface $storage,
        ConfigAdministration    $configAdministration
    ) {
        $user = $storage->getToken()->getUser();
        $configAdministration->setConfig();
        if ($user instanceof Users && $user->isActive() == true) {
            return $this->json([
                'user' =>       $this->normalizer->normalize($user, null, ['groups' => 'auth']),
                'config' =>     $configAdministration->getConfig(),
            ], 200);
        } else {
            return $this->json([
                'status' => false,
            ], 401);
        }
    }

    /**
     * @param TokenStorageInterface $storage
     * @return JsonResponse
     * @Route("/admin/api/auth/logout", name="admin-api-auth-logout", methods={"POST", "GET"})
     */
    public function logout(TokenStorageInterface $storage)
    {
        $storage->getToken()->eraseCredentials();

        return $this->json([
            'logout' => true,
        ]);
    }
}
