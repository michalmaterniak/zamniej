<?php
namespace App\Services\Pages\Resource\Remove;

use App\Services\Pages\Resource\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ResourceRemove
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var Resource $resource
     */
    protected $resource;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadResource(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function removeResource(): bool
    {
        try {
            $this->entityManager->beginTransaction();

            foreach ($this->resource->getModelEntity()->getSubpages() as $subpage) {
                $this->entityManager->remove($subpage);
            }

            $this->entityManager->remove($this->resource->getModelResource());
            $this->entityManager->remove($this->resource->getModelEntity()->getConfig());
            $this->entityManager->remove($this->resource->getModelEntity()->getContent());
            $this->entityManager->remove($this->resource->getModelEntity());

            $this->entityManager->flush();

            $this->entityManager->commit();
            return true;
        } catch (Exception $exception) {
            dump($exception);
            return false;
        }
    }
}
