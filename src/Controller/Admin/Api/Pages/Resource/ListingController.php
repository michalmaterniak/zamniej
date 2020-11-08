<?php
namespace App\Controller\Admin\Api\Pages\Resource;

use App\Application\Admin\Resources\Listing\ListingResourceConfig;
use App\Application\Pages\PagesManager;
use App\Repository\Repositories\Subpages\Pages\HomepageRepository;
use App\Repository\Repositories\Subpages\ResourcesRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Twig\TemplateVars;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ListingController extends AbstractResourceController
{
    public function __construct(
        NormalizerInterface $normalizer,
        PagesManager $modelPagesManager,
        TemplateVars $templateVars
    )
    {
        parent::__construct($normalizer, $modelPagesManager, $templateVars);
    }

    /**
     * @param int $idParent
     * @param HomepageRepository $homepageRepository
     * @param ResourcesRepository $resourcesRepository
     * @param ListingResourceConfig $listingResourceConfig
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-listing/{idParent}", name="admin-api-pages-resource-listing", methods={"POST"}, requirements={"idParent"="\d+"}, defaults={"idParent" : 0})
     */
    public function listing(
        int $idParent,
        HomepageRepository $homepageRepository,
        ResourcesRepository $resourcesRepository,
        ListingResourceConfig $listingResourceConfig
    ): Response
    {
        if ($idParent === 0) {
            $resource = $homepageRepository->select(false)->withChildren()->withConfig()->getResultOrNull();
        } else {
            $resource = $resourcesRepository->select(false)->withChildrenByParentId($idParent)->withConfig()->getResultOrNull();

        }

        if (!$resource) {
            throw new NotFoundHttpException('Nie ma takiej strony');
        }

        $modelResource = $this->pagesManager->loadEntity($resource);
        $this->templateVars->insert('configListing', $listingResourceConfig->getConfigListing($modelResource));
        $controller = $modelResource->getComponents()->getResourceConfig()->getController();

        $this->templateVars->insert('resources', $this->normalizer->normalize($modelResource->getChildren(), null, [
            'groups' => 'resource-admin-list',
        ]));

        if ($this->canForward($controller, 'listing')) {
            return $this->forward($this->returnClassNameController($controller) . "::listing", [
                'resource' => $modelResource,
            ]);
        }
        return $this->responseJson();
    }

    /**
     * @param RequestPostContentData $requestPostContentData
     * @param ResourcesRepository $resourcesRepository
     * @return Response
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/resource-listing-search", name="admin-api-pages-resource-listing-search", methods={"POST"})
     */
    public function search(RequestPostContentData $requestPostContentData, ResourcesRepository $resourcesRepository) : Response
    {
        $models = $this->pagesManager->loadEntities($resourcesRepository->select()->bySearchText($requestPostContentData->getValue('search', ''))->withConfig()->getResults());
        return $this->json([
            'resources' => $this->normalizer->normalize($models, null, [
                'groups' => 'resource-admin-list',
            ]),
        ]);
    }
}
