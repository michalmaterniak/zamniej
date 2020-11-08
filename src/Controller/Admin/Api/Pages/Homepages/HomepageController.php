<?php
namespace App\Controller\Admin\Api\Pages\Homepages;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Homepage\Homepage;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
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

    /**
     * @param Homepage $resource
     * @param FormBuilderResources $formBuilder
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function item(Homepage $resource, FormBuilderResources $formBuilder)
    {
        $this->templateVars->insert('form', $this->normalizer->normalize($formBuilder->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }
}
