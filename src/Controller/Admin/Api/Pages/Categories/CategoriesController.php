<?php

namespace App\Controller\Admin\Api\Pages\Categories;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Page\Page;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Repository\Repositories\Subpages\Pages\CategoryRepository;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class CategoriesController extends AbstractResourceController
{
    public function item(Page $resource, FormBuilderResources $formBuilder)
    {
        $form = $formBuilder
            ->create()
                ->basic()
                    ->add(new TextField('Nazwa', 'name'))

            ->subpage()
                    ->add(new TextField('Nazwa', 'name'))
                    ->add(new WysiwygField('Treść', 'content.content'))
                ->seo()
                    ->add(new TextareaField('Tytuł', 'title'))
                    ->add(new TextareaField('Nagłówek H1', 'header'))
                    ->add(new TextareaField('Meta description', 'description'));

        $this->templateVars->insert('form', $this->normalizer->normalize($form->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }

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
