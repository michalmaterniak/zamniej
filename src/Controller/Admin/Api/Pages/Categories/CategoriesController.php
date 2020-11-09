<?php

namespace App\Controller\Admin\Api\Pages\Categories;

use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class CategoriesController extends AbstractResourceController
{
    /**
     * @param RequestPostContentData $contentData
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/pages/categories-listing", name="admin-api-pages-categories-listing", methods={"POST"})
     */
    public function getCategoriesByName(RequestPostContentData $contentData, CategoryRepository $categoryRepository)
    {
        if (!$contentData->checkIfExist('category')) {
            return $this->json([
                'message' => 'Nie wskazano nazwe kategorii',
            ], 500);
        }

        $subpages = [];
        foreach ($categoryRepository->select(false)->searchCategoryByText($contentData->getValue('category'))->getResults() as $category)
        {
            foreach ($category->getSubpages() as $subpage)
            {
                $subpages[] = $subpage;
            }
        }

        $this->templateVars->insert('categories', $this->normalizer->normalize($subpages, null, [
            'groups' => ["resource-admin-list"],
        ]));

        return $this->responseJson();
    }
}
