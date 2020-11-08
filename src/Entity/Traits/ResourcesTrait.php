<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Subpages\Resources;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

trait ResourcesTrait
{
    /**
     * @var Resources $resource
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\Subpages\Resources", cascade={"persist"})
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id_resource", nullable=true)
     */
    protected $resource = null;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=700, nullable=false)
     */
    protected $name;

    /**
     * @return Resources
     */
    public function getResource(): Resources
    {
        return $this->resource;
    }

    /**
     * @param Resources $resource
     */
    public function setResource(Resources $resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
