<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampTrait
{
    /**
     * @var \DateTime $modified
     * @ORM\Column(name="modified", type="datetime", options={"default" : "CURRENT_TIMESTAMP"})
     * @Groups({"resource", "resource-admin"})
     */
    protected $modified;

    /**
     * @var \DateTime $created
     * @ORM\Column(name="created", type="datetime", options={"default" : "CURRENT_TIMESTAMP"})
     * @Groups({"resource", "resource-admin"})
     */
    protected $created;

    /**
     * @return \DateTime
     */
    public function getModified(): \DateTime
    {
        return $this->modified;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setModified(\DateTime $dateTime = null)
    {
        if (!$dateTime) {
            $dateTime = new \DateTime();
        }

        $this->modified = $dateTime;
    }

    /**
     * @ORM\PrePersist
     */
    public function _setCreatedOn()
    {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
    }


    /**
     * @param PreUpdateEventArgs $preUpdateEventArgs
     * @ORM\PreUpdate
     */
    public function _setModified(PreUpdateEventArgs $preUpdateEventArgs): void
    {
        $this->setModified();
    }
}
