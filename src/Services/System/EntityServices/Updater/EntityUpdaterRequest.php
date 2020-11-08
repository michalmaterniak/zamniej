<?php
namespace App\Services\System\EntityServices\Updater;
use App\Entity\Interfaces\EntityInterface;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;

class EntityUpdaterRequest
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var EntityUpdater $entityUpdater
     */
    protected $entityUpdater;

    /**
     * @var RequestPostContentData $requestPostContentData
     */
    protected $requestPostContentData;

    public function __construct(
        EntityUpdater $entityUpdater,
        EntityManagerInterface $entityManager,
        RequestPostContentData $requestPostContentData
    )
    {
        $this->entityManager = $entityManager;
        $this->requestPostContentData = $requestPostContentData;
        $this->entityUpdater = $entityUpdater;
    }

    public function updateRequestEntity(EntityInterface $entity)
    {
        if($this->requestPostContentData->checkIfExist('modelEntity'))
        {
            $this->entityUpdater->setEntity($entity);
            $this->entityUpdater->update($this->requestPostContentData->getValue('modelEntity'));
        }
    }

    public function save()
    {
        $this->entityManager->flush();
    }
}
