<?php
namespace App\EventListener;

use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Entities\Subpages\Resources;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ResourceChildModifySubscriber implements EventSubscriber
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
            Events::postPersist,
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof Resources) {
            if ($object->getParent() !== null) {
                $object->getParent()->addChild(-1);
            }
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        /**
         * @var Resources $args
         */
        $object = $args->getObject();
        if ($object instanceof Resources) {
            if ($object->getParent() !== null) {
                $object->getParent()->addChild();
            }
        }
    }
}
