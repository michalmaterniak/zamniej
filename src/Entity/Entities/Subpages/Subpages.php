<?php
namespace App\Entity\Entities\Subpages;

use App\Entity\Entities\Subpages\Subpage\Seo;
use App\Entity\Entities\System\Contents;
use App\Entity\Entities\System\Files;
use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\DataTrait;
use App\Entity\Traits\FilesManagmentTrait;
use App\Entity\Traits\SubpagesTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ErrorException;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Subpages
 * @ORM\Table(name="subpages",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="locale_slug", columns={"locale", "slug"}),
 *        @ORM\UniqueConstraint(name="resource_locale", columns={"resource_id", "locale"}),
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Subpages\SubpagesRepository")
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Podana nazwa podstrony już istnieje",
 *     entityClass="App\Entity\Entities\Subpages\Subpages"
 * )
 */
class Subpages implements EntityInterface
{
    use SubpagesTrait, FilesManagmentTrait, DataTrait;

    /**
     * @var int $idSubpage
     * @ORM\Column(name="id_subpage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-list", "program-admin", "search-to-tie-programs", "program-admin-list"})
     */
    protected $idSubpage;

    /**
     * @var string $locale
     * @ORM\Column(name="locale", type="string", length=5, nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $locale;

    /**
     * @var string $slug
     * @ORM\Column(name="slug", type="string", length=500, nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $slug = null;

    /**
     * @var string $path
     * @ORM\Column(name="path", type="string", length=500, nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $path = null;

    /**
     * @var bool $active
     * @ORM\Column(name="active", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-list", "program-admin-list"})
     */
    protected $active = true;

    /**
     * @var Resources $resource
     * @ORM\ManyToOne(targetEntity="Resources", inversedBy="subpages", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id_resource", onDelete="CASCADE", nullable=false)
     * @Groups({"program-admin-list", "program-admin"})
     */
    protected $resource;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=700, nullable=false, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 700,
     *      minMessage = "Minimalna ilość znaków nazwy to {{ limit }}",
     *      maxMessage = "Maksymalna ilość znaków nazwy to {{ limit }}",
     *      allowEmptyString = false
     * )
     * @Groups({"resource", "resource-admin", "resource-admin-list", "search-to-tie-programs", "program-admin-list"})
     */
    protected $name;

    /**
     * @var Contents $content
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\System\Contents", cascade={"persist", "remove"}, fetch="LAZY", orphanRemoval=true)
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id_content", onDelete="CASCADE")
     * @Assert\Valid
     * @Groups({"resource", "resource-admin"})
     */
    protected $content;

    /**
     * @var Seo $seo
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\Subpages\Subpage\Seo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="seo_id", referencedColumnName="id_seo")
     * @Groups({"resource-admin"})
     */
    protected $seo;

    /**
     * @var Files[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Entities\System\Files", fetch="LAZY", cascade={"remove"})
     * @ORM\JoinTable(name="files_subpages",
     *      joinColumns={@ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id_file", unique=true)}
     *      )
     * @Groups({"resource-admin"})
     */
    protected $files;

    /**
     * @var DateTime $datetimeCreate
     * @ORM\Column(name="datetime_create", type="datetime", nullable=false)
     * @Groups({"resource", "resource-admin", "program-admin-list"})
     */
    protected $datetimeCreate;

    /**
     * Subpages constructor.
     * @param string $name
     * @param string $locale
     */
    public function __construct(string $name, string $locale)
    {
        $this->name =               $name;
        $this->locale =             $locale;
        $this->content =            new Contents();
        $this->seo =                new Seo();
        $this->files = new ArrayCollection();
        $this->datetimeCreate = new DateTime();
    }

    /**
     * @return int
     */
    public function getIdSubpage(): int
    {
        return $this->idSubpage;
    }

    /**
     * @param int $idSubpage
     */
    public function setIdSubpage(int $idSubpage): void
    {
        $this->idSubpage = $idSubpage;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getResource()->isActive() && $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

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

    /**
     * @return Contents
     */
    public function getContent(): Contents
    {
        return $this->content;
    }

    /**
     * @param $content
     * @throws ErrorException
     */
    public function setContent($content): void
    {
        if ($content instanceof Contents) {
            $this->content = $content;
        } elseif (is_string($content) || $content === null) {
            $this->content->setContent($content ?: '');
        } else {
            throw new ErrorException('Type of content is unknown');
        }
    }
    protected function getInstance(): Subpages
    {
        return $this;
    }

    /**
     * @return Seo
     */
    public function getSeo(): Seo
    {
        return $this->seo;
    }

    public function isEqual(Subpages $subpage)
    {
        return $this->getIdSubpage() === $subpage->getIdSubpage();
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
}
