<?php
namespace App\Controller\Admin\Api\Pages\Homepages;

use App\Application\Pages\Homepage\Homepage;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
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
}
