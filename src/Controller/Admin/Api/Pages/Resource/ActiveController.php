<?php

namespace App\Controller\Admin\Api\Pages\Resource;

use App\Entity\Entities\Subpages\Subpages;
use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ActiveController extends AbstractResourceController
{
    /**
     * @param Subpages $subpage
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/subpage-active/{active}/{subpage}", name="admin-api-pages-subpage-active", methods={"POST"}, requirements={"active"="0|1","subpage"="\d+"})
     */
    public function active(
        bool $active,
        Subpages $subpage
    ): Response
    {
        try {
            $resourceModel = $this->pagesManager->loadEntity($subpage->getResource());
            $controller = $resourceModel->getComponents()->getResourceConfig()->getController();
            if ($this->canForward($controller, 'active')) {
                return $this->forward($this->returnClassNameController($controller) . "::active", [
                    'resource' => $resourceModel,
                ]);
            }
            if (!$resourceModel) {
                throw new ErrorException();
            }

            $subpage->setActive($active);
            $this->getDoctrine()->getManager()->flush();

            return $this->json([
                'status' => true,
                'resource' => $this->normalizer->normalize($resourceModel, null, [
                    'groups' => 'resource-admin',
                ]),
                'active' => $subpage->isActive()
            ]);
        } catch (ErrorException $exception) {
            return $this->json([
                'message' => 'Nie można ustawić aktywności podstrony'
            ], 500);
        }
    }
}
