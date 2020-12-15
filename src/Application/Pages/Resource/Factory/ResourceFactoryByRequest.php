<?php
namespace App\Application\Pages\Resource\Factory;


use App\Entity\Entities\Subpages\Resources;
use App\Services\Pages\Resource\Resource;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;

class ResourceFactoryByRequest
{
    /**
     * @var RequestPostContentData $requestPostContentData
     */
    protected $requestPostContentData;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(
        RequestPostContentData $requestPostContentData,
        EntityManagerInterface $entityManager
    )
    {
        $this->requestPostContentData = $requestPostContentData;
        $this->entityManager = $entityManager;
    }

    public function create(Resource $parent, Resource $resource): Resources
    {
        if (!$this->requestPostContentData->checkIfExist('modelEntity')) {
            throw new ErrorException('model data is not defined');
        }
        $entityModel = $this->requestPostContentData->getValue('modelEntity');

        if (empty($entityModel['name'])) {
            throw new ErrorException('Name is not defined');
        }
        $resourceFactory = $resource->getComponents()->getResourceFactory()->create($entityModel['name'], $parent->getModelEntity());
        $resourceFactory->save();
        return $resourceFactory->getPageCreate()->getResource();
    }
}
