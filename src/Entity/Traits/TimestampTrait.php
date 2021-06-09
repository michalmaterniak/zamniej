<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampTrait
{
    /**
     * @var \DateTime $created
     * @ORM\Column(name="modified", type="datetime", columnDefinition="DATETIME on update CURRENT_TIMESTAMP", options={"default" : "CURRENT_TIMESTAMP"})
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
     * @param \DateTime $modified
     */
    public function setModified(\DateTime $modified): void
    {
        $this->modified = $modified;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModifiedOn()
    {
        $this->created = new \DateTime();
    }

}
