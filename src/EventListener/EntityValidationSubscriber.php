<?php
namespace App\EventListener;

use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Entities\Subpages\Resources;
use App\Entity\Interfaces\EntityInterface;
use App\EventListener\Validation\ValidatorEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityValidationSubscriber implements EventSubscriber
{
    /**
     * @var ValidatorEntity $validatorEntities
     */
    protected $validatorEntities;

    public function __construct(ValidatorEntity $validatorEntities)
    {
        $this->validatorEntities = $validatorEntities;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /**
         * @var EntityInterface $entity
         */
        $entity = $args->getObject();
        $this->validatorEntities->validate($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        /**
         * @var EntityInterface $entity
         */
        $entity = $args->getObject();
        $this->validatorEntities->validate($entity);
    }
}
