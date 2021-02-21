<?php
namespace App\Entity\Entities\Subpages;

use App\Entity\Entities\Subpages\Resource\ResourcesConfig;
use App\Entity\Entities\System\Contents;
use App\Entity\Entities\System\Files;
use App\Entity\Interfaces\EntityInterface;
use App\Entity\Interfaces\ResourcesInterface;
use App\Entity\Traits\FilesManagmentTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Resources
 * @ORM\Table(name="resources",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="name_parent", columns={"name", "parent_id"}),
 *        @ORM\UniqueConstraint(name="resource_type_resource_id", columns={"resource_type", "resource_id"}),
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Subpages\ResourcesRepository")
 *
 * @UniqueEntity(
 *     fields={"name", "parent"},
 *     message="Podana nazwa: {{ value }} już istnieje w obrębie rodzica",
 *     entityClass="App\Entity\Entities\Subpages\Resources"
 * )
 */
class Resources implements EntityInterface
{
    use FilesManagmentTrait;
    /**
     * @var int $idResource
     * @ORM\Column(name="id_resource", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-list", "program-admin-list"})
     */
    protected $idResource;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=700, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 700,
     *      minMessage = "Minimalna ilość znaków nazwy to {{ limit }}",
     *      maxMessage = "Maksymalna ilość znaków nazwy to {{ limit }}",
     *      allowEmptyString = false
     * )
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $name;

    /**
     * @var bool $active
     * @ORM\Column(name="active", type="boolean", nullable=false)
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $active = true;

    /**
     * @var ResourcesConfig $config
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\Subpages\Resource\ResourcesConfig", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id_resource_admin")
     * @Assert\Valid
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $config;

    /**
     * @var Subpages[]|ArrayCollection $subpages
     * @ORM\OneToMany(targetEntity="Subpages", mappedBy="resource", indexBy="locale", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $subpages;

    /**
     * @var int $deep
     * @ORM\Column(name="deep", type="integer", length=5, nullable=false)
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $deep = 0;

    /**
     * @var Resources[]|ArrayCollection $parents
     * @ORM\ManyToMany(targetEntity="Resources", fetch="LAZY")
     * @ORM\JoinTable(name="map_parents_resources",
     *      joinColumns={@ORM\JoinColumn(name="resource_id", referencedColumnName="id_resource")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id_resource")}
     *      )
     */
    protected $parents;

    /**
     * @var Resources[]|ArrayCollection $children
     * @ORM\OneToMany(targetEntity="Resources", mappedBy="parent", fetch="LAZY")
     */
    protected $children;

    /**
     * @var int $countChildren
     * @ORM\Column(name="count_children", type="integer", length=5, nullable=false)
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $countChildren = 0;

    /**
     * @var Resources|null $parent
     * @ORM\ManyToOne(targetEntity="Resources", inversedBy="children", fetch="LAZY")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id_resource", nullable=true)
     */
    protected $parent;

    /**
     * @var Contents $content
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\System\Contents", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id_content", onDelete="CASCADE")
     * @Assert\Valid
     * @Groups({"resource-admin"})
     */
    protected $content;

    /**
     * @var Files[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Entities\System\Files", fetch="LAZY", cascade={"remove"}, orphanRemoval=true)
     * @ORM\JoinTable(name="files_resources",
     *      joinColumns={@ORM\JoinColumn(name="resource_id", referencedColumnName="id_resource")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id_file", unique=true)}
     *      )
     * @Groups({"resource-admin"})
     */
    protected $files;

    /**
     * @var DateTime $datetimeCreate
     * @ORM\Column(name="datetime_create", type="datetime", nullable=false)
     */
    protected $datetimeCreate;

    /**
     * @var string $resourceType
     * @ORM\Column(name="resource_type", type="smallint", nullable=false)
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $resourceType = 0;

    /**
     * @var int $resource
     * @ORM\Column(name="resource_id", type="integer", length=11, nullable=false)
     * @Groups({"resource-admin", "resource-admin-list"})
     */
    protected $resourceId;

    /**
     * @var int $priority
     * @ORM\Column(name="priority", type="smallint", nullable=false)
     */
    protected $priority = 0;

    /**
     * Resources constructor.
     * @param string $name
     * @param int $type
     * @param ResourcesInterface $resource
     * @param Resources|null $parent
     */
    public function __construct(string $name, int $type, ResourcesInterface $resource, ?Resources $parent = null)
    {
        $this->subpages = new ArrayCollection();
        $this->config = new ResourcesConfig();
        $this->parents = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->content = new Contents();
        $this->datetimeCreate = new DateTime();
        $this->setName($name);
        $this->setResourceType($type);
        $this->setResourceId($resource->getId());
        $this->setParent($parent);
    }

    /**
     * @return int
     */
    public function getIdResource(): int
    {
        return $this->idResource;
    }

    /**
     * @param int $idResource
     */
    public function setIdResource(int $idResource): void
    {
        $this->idResource = $idResource;
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

    /**
     * @return Subpages[]|ArrayCollection
     */
    public function getSubpages()
    {
        return $this->subpages;
    }

    /**
     * @param string $locale
     * @return Subpages|null
     */
    public function getSubpage(string $locale) : ?Subpages
    {
        return $this->subpages->get($locale);
    }

    public function addSubpage(Subpages $subpage)
    {
        $subpage->setResource($this);
        $this->subpages->set($subpage->getLocale(), $subpage);

        return $subpage;
    }

    /**
     * @return ResourcesConfig
     */
    public function getConfig(): ResourcesConfig
    {
        return $this->config;
    }

    /**
     * @param ResourcesConfig $config
     */
    public function setConfig(ResourcesConfig $config): void
    {
        $this->config = $config;
    }

    /**
     * @return int
     */
    public function getDeep(): int
    {
        return $this->deep;
    }

    /**
     * @param int $deep
     */
    public function setDeep(int $deep): void
    {
        $this->deep = $deep;
    }

    /**
     * @return Resources|null
     */
    public function getParent(): ?Resources
    {
        return $this->parent;
    }

    /**
     * @param Resources|null $parent
     */
    public function setParent(?Resources $parent): void
    {
        $this->parent = $parent;
        if ($parent) {
            foreach ($parent->getParents() as $parentT) {
                $this->parents->add($parentT);
            }
            $this->parents->add($parent);
            $this->deep = $parent ? ($parent->getDeep()+1) : 0;
        }
    }

    public function addChild(int $count = 1)
    {
        $this->countChildren = $this->countChildren + $count;
    }
    /**
     * @return Resources[]|ArrayCollection
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return Resources[]|ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return int
     */
    public function getCountChildren(): int
    {
        return $this->countChildren;
    }

    public function equal(Resources $resource)
    {
        return $this->getIdResource() === $resource->getIdResource();
    }

    /**
     * @return Contents
     */
    public function getContent(): Contents
    {
        return $this->content;
    }

    /**
     * @param Contents $content
     */
    public function setContent(Contents $content): void
    {
        $this->content = $content;
    }

    /**
     * @return Files[]|ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return DateTime
     */
    public function getDatetimeCreate(): DateTime
    {
        return $this->datetimeCreate;
    }

    /**
     * @param DateTime $datetimeCreate
     */
    public function setDatetimeCreate(DateTime $datetimeCreate): void
    {
        $this->datetimeCreate = $datetimeCreate;
    }

    /**
     * @return int
     */
    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    /**
     * @param int $resourceId
     */
    public function setResourceId(int $resourceId): void
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return $this->resourceType;
    }

    /**
     * @param string $resourceType
     */
    public function setResourceType(string $resourceType): void
    {
        $this->resourceType = $resourceType;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function addPriority(int $count = 1)
    {
        $this->priority += $count;
    }
}
