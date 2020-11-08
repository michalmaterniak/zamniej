<?php


namespace App\Services\System\ModelsManager;

use App\Entity\Interfaces\EntityInterface;

class ModelEntity
{
    /**
     * @var EntityInterface $entity
     */
    private $entity;

    public function loadEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return EntityInterface
     */
    protected function getEntity(): EntityInterface
    {
        return $this->entity;
    }
}
