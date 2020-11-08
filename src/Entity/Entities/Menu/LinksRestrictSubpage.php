<?php
namespace App\Entity\Entities\Menu;

use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LinksRestrictSubpage
 * @ORM\Table(name="links_restrict_subpage")
 * @ORM\Entity
 */
class LinksRestrictSubpage implements EntityInterface
{
    /**
     * @var int $idLink
     * @ORM\Column(name="id_link", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idLink;

    /**
     * @var string $anchor
     * @ORM\Column(name="anchor", type="string", length=200, nullable=false)
     */
    protected $anchor = '';

    /**
     * @var string $group
     * @ORM\Column(name="batch", type="string", length=50, nullable=false)
     */
    protected $group;

    /**
     * @var Subpages $subpage
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages")
     * @ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", nullable=true)
     */
    protected $internal = null;

    /**
     * @var string|null $external
     * @ORM\Column(name="external", type="string", length=200, nullable=true)
     */
    protected $external = '#';
    /**
     * @var Links|null $parent
     * @ORM\ManyToOne(targetEntity="Links", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id_link", nullable=true)
     */
    protected ?Links $parent = null;

    /**
     * @var Links[]|ArrayCollection $children
     * @ORM\OneToMany(targetEntity="Links", mappedBy="parent")
     */
    protected $children;

    /**
     * @var string $locale
     * @ORM\Column(name="locale", type="string", length=10, nullable=false)
     */
    protected $locale;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdLink(): int
    {
        return $this->idLink;
    }

    /**
     * @param int $idLink
     */
    public function setIdLink(int $idLink): void
    {
        $this->idLink = $idLink;
    }

    /**
     * @return string
     */
    public function getAnchor(): string
    {
        return $this->anchor;
    }

    /**
     * @param string $anchor
     */
    public function setAnchor(string $anchor): void
    {
        $this->anchor = $anchor;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return Links|null
     */
    public function getParent(): ?Links
    {
        return $this->parent;
    }

    /**
     * @param Links|null $parent
     */
    public function setParent(?Links $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Links[]|ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Links[]|ArrayCollection $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
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
     * @return Subpages|null
     */
    public function getInternal(): ?Subpages
    {
        return $this->internal;
    }

    /**
     * @param Subpages|null $internal
     */
    public function setInternal(?Subpages $internal): void
    {
        $this->internal = $internal;
    }

    /**
     * @return string|null
     */
    public function getExternal(): ?string
    {
        return $this->external;
    }

    /**
     * @param string|null $external
     */
    public function setExternal(?string $external): void
    {
        $this->external = $external;
    }

    public function isActive(Subpages $subpage) : bool
    {
        return $this->getInternal() && $this->getInternal()->getIdSubpage() === $subpage->getIdSubpage();
    }
}
