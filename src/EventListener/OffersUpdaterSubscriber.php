<?php
namespace App\EventListener;

use App\Entity\Entities\Affiliations\OffersAffiliation;
use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Subpages\Resources;
use App\Entity\Interfaces\UpdateDatetimeInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class OffersUpdaterSubscriber implements EventSubscriber
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
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $offer = $args->getObject();
        if ($offer instanceof UpdateDatetimeInterface) {
            $offer->setDatetimeUpdate(new \DateTime());
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof Resources && !($object instanceof Homepages)) {
            $object->getParent()->addChild();
        }
    }
}
