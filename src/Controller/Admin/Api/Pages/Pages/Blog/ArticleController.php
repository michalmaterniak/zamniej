<?php
namespace App\Controller\Admin\Api\Pages\Pages\Blog;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Page\Page;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Services\Admin\Form\Fields\Files\PhotoField;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ArticleController extends AbstractResourceController
{
    private function createFormResource(FormBuilderResources $formBuilderResources): FormBuilderResources
    {
        return $formBuilderResources
            ->create()
            ->basic()
            ->add(new TextField('Nazwa', 'name'))
            ->subpage()
            ->add(new TextField('Nazwa', 'name'))
            ->add(new WysiwygField('Treść', 'content.content'))
            ->add(new PhotoField('Zdjęcie nagłówek', 'files', 'header'))
            ->seo()
            ->add(new TextareaField('Tytuł', 'title'))
            ->add(new TextareaField('Nagłówek H1', 'header'))
            ->add(new TextareaField('Meta description', 'description'));
    }

    /**
     * @param Page $resource
     * @param FormBuilderResources $formBuilderResources
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function item(Page $resource, FormBuilderResources $formBuilderResources)
    {
        $this->templateVars->insert('form', $this->normalizer->normalize($this->createFormResource($formBuilderResources)->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }

    /**
     * @param FormBuilderResources $formBuilderResources
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function form(FormBuilderResources $formBuilderResources)
    {
        $this->templateVars->insert('form', $this->normalizer->normalize($this->createFormResource($formBuilderResources)->build()));
        return $this->responseJson();
    }
}
