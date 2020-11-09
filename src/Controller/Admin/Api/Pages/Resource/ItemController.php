<?php
namespace App\Controller\Admin\Api\Pages\Resource;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\PagesManager;
use App\Application\Pages\Resource\Factory\ResourceFactoryByRequest;
use App\Entity\Entities\Subpages\Resources;
use App\Services\System\EntityServices\Updater\EntityUpdaterRequest;
use App\Twig\TemplateVars;
use ErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ItemController extends AbstractResourceController
{

    /**
     * @var ValidatorInterface $validator
     */
    protected $validator;

    public function __construct(
        NormalizerInterface $normalizer,
        PagesManager $modelPagesManager,
        ValidatorInterface $validator,
        TemplateVars $templateVars
    )
    {
        parent::__construct($normalizer, $modelPagesManager, $templateVars);
        $this->validator = $validator;
    }

    /**
     * @param int $child
     * @param FormBuilderResources $formBuilderResources
     * @param PagesManager $pagesManager
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-form-child/{idResource}/{child}", name="admin-api-pages-resource-formChild", methods={"POST"}, requirements={"idResource"="\d+", "child"="\d+"})
     */
    public function formChild(
        int $child,
        FormBuilderResources $formBuilderResources,
        PagesManager $pagesManager
    ): Response
    {
        $parentModel = $this->pagesManager->getCurrentResourceModel();
        if (!$parentModel->getComponents()->getResourceConfig()->isAvailableTypeChild($child)) {
            throw new ErrorException('Child is not available');
        }

        $model = $pagesManager->getResourceModel($child);

        if (!$model) {
            throw new NotFoundHttpException('Nie ma takiej strony');
        }

        $controller = $model->getComponents()->getResourceConfig()->getController();

        if ($this->canForward($controller, 'form')) {
            return $this->forward($this->returnClassNameController($controller) . "::form", [
                'resource' => $parentModel,
            ]);
        }

        $this->templateVars->insert('form', $this->normalizer->normalize($formBuilderResources->build()));

        return $this->responseJson();
    }

    /**
     * @param int $child
     * @param PagesManager $pagesManager
     * @param ResourceFactoryByRequest $resourceFactoryByRequest
     * @param EntityUpdaterRequest $entityUpdaterRequest
     * @return Response
     * @throws ErrorException
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-new/{idResource}/{child}", name="admin-api-pages-resource-new", methods={"POST"}, requirements={"idResource"="\d+"})
     */
    public function new(
        int $child,
        PagesManager $pagesManager,
        ResourceFactoryByRequest $resourceFactoryByRequest,
        EntityUpdaterRequest $entityUpdaterRequest
    ): Response
    {
        $parentModel = $this->pagesManager->getCurrentResourceModel();
        if (!$parentModel->getComponents()->getResourceConfig()->isAvailableTypeChild($child)) {
            throw new ErrorException('Child is not available');
        }

        $resourceModel = $pagesManager->getResourceModel($child);
        $entity = $resourceFactoryByRequest->create($parentModel, $resourceModel);
        $entityUpdaterRequest->updateRequestEntity($entity);
        $errors = $this->validator->validate($resourceModel);
        if ($errors->count() > 0) {
            $entityUpdaterRequest->save();
            return $this->json([
                'status' => false,
                'errors' => $errors,
            ], 400);
        } else {
            $this->templateVars->insert('resource', $this->normalizer->normalize($pagesManager->loadEntity($entity), null, [
                'groups' => ["resource-admin"],
            ]));

            return $this->responseJson();

        }

    }

    /**
     * @param FormBuilderResources $formBuilderResources
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-item/{idResource}", name="admin-api-pages-resource-item", methods={"POST"}, requirements={"idResource"="\d+"})
     */
    public function item(FormBuilderResources $formBuilderResources): Response
    {
        $pageModel = $this->pagesManager->getCurrentResourceModel();
        if (!$pageModel) {
            throw new NotFoundHttpException('Nie ma takiej strony');
        }

        $controller = $pageModel->getComponents()->getResourceConfig()->getController();

        if ($this->canForward($controller, 'item')) {
            return $this->forward($this->returnClassNameController($controller)."::item", [
                'resource'  => $pageModel,
            ]);
        }

        $this->templateVars->insert('form', $this->normalizer->normalize($formBuilderResources->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($pageModel, null, [
            'groups' => ["resource-admin"],
        ]));
        return $this->responseJson();
    }

    /**
     * @param Resources $resource
     * @return Response
     * @Route("/admin/api/pages/resource-remove/{resource}", name="admin-api-pages-resource-remove", methods={"POST"}, requirements={"resource"="\d+"})
     */
    public function remove(Resources $resource): Response
    {
        $resourceModel = $this->pagesManager->loadEntity($resource);

        $controller = $resourceModel->getComponents()->getResourceConfig()->getController();
        if ($this->canForward($controller, 'remove')) {
            return $this->forward($this->returnClassNameController($controller) . "::item", [
                'resource' => $resourceModel,
            ]);
        }
        try {
            $success = $resourceModel->getResourceRemove()->removeResource();
            return $this->responseJson(['status' => $success], $success ? 200 : 500);

        } catch (ErrorException $exception) {
            return $this->responseJson([
                'message' => $exception->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    /**
     * @param Resources $resource
     * @param EntityUpdaterRequest $entityUpdaterRequest
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-store/{resource}", name="admin-api-pages-resource-store", methods={"POST"}, requirements={"resource"="\d+"})
     */
    public function store(
        Resources $resource,
        EntityUpdaterRequest $entityUpdaterRequest
    ): Response
    {
        $resourceModel = $this->pagesManager->loadEntity($resource);
        $controller = $resourceModel->getComponents()->getResourceConfig()->getController();
        if ($this->canForward($controller, 'store')) {
            return $this->forward($this->returnClassNameController($controller) . "::item", [
                'resource' => $resourceModel,
            ]);
        }
        $entityUpdaterRequest->updateRequestEntity($resource);

        $errors = $this->validator->validate($resource);
        if ($errors->count() > 0) {
            return $this->json([
                'status' => false,
                'errors' => $errors,
            ], 400);
        } else {
            $entityUpdaterRequest->save();

            return $this->json([
                'status' => true,
                'resource' => $this->normalizer->normalize($resourceModel, null, [
                    'groups' => 'resource-admin',
                ]),
            ]);
        }
    }

}
