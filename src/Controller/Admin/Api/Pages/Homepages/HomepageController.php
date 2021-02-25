<?php
namespace App\Controller\Admin\Api\Pages\Homepages;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Homepage\Homepage;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Services\Admin\Form\Fields\Text\NumericField;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class HomepageController extends AbstractResourceController
{
    /**
     * @param Homepage $resource
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function listing(Homepage $resource)
    {
        $modelsChildren = $resource->getChildren();
        $this->templateVars->insert('resources', $this->normalizer->normalize(array_merge([$resource], $modelsChildren->toArray()), null, [
            'groups' => 'resource-admin-list',
        ]));

        return $this->responseJson();
    }

    private function createFormResource(FormBuilderResources $formBuilderResources): FormBuilderResources
    {
        return $formBuilderResources
            ->create()
            ->basic()
            ->add(new TextField('Nazwa', 'name'))
            ->subpage()
            ->add(new TextField('Nazwa', 'name'))
            ->add(new WysiwygField('Wstęp', 'content.data.lead'))
            ->add(new WysiwygField('Treść', 'content.content'))
            ->subtab('Konfiguracje', 'config')
            ->add(new NumericField('Ilość popularnych sklepów', 'data.config.amountPopularShops'))
            ->seo()
            ->add(new TextareaField('Tytuł', 'title'))
            ->add(new TextareaField('Nagłówek H1', 'header'))
            ->add(new TextareaField('Meta description', 'description'));
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

    /**
     * @param Homepage $resource
     * @param FormBuilderResources $formBuilderResources
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function item(Homepage $resource, FormBuilderResources $formBuilderResources)
    {
        $resource->setModelResource();

        $this->templateVars->insert('form', $this->normalizer->normalize($this->createFormResource($formBuilderResources)->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }
}
