<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Subpages\Resources;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TreeTrait
{

    /**
     * @var int $lft
     * @Gedmo\TreeLeft()
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;

    /**
     * @var int lvl
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;

    /**
     * @var int $rgt
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;

    /**
     * @var Resources $root
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Resources")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id_resource", onDelete="CASCADE")
     */
    protected $root;

    /**
     * @var Resources $root
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Resources", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id_resource", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @var Resources[]|ArrayCollection $root
     * @ORM\OneToMany(targetEntity="App\Entity\Entities\Subpages\Resources", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /**
     * @return int
     */
    public function getLft(): int
    {
        return $this->lft;
    }

    /**
     * @param int $lft
     */
    public function setLft(int $lft): void
    {
        $this->lft = $lft;
    }

    /**
     * @return int
     */
    public function getLvl(): int
    {
        return $this->lvl;
    }

    /**
     * @param int $lvl
     */
    public function setLvl(int $lvl): void
    {
        $this->lvl = $lvl;
    }

    /**
     * @return int
     */
    public function getRgt(): int
    {
        return $this->rgt;
    }

    /**
     * @param int $rgt
     */
    public function setRgt(int $rgt): void
    {
        $this->rgt = $rgt;
    }

    /**
     * @return Resources
     */
    public function getRoot(): Resources
    {
        return $this->root;
    }

    /**
     * @param Resources $root
     */
    public function setRoot(Resources $root): void
    {
        $this->root = $root;
    }

    /**
     * @return Resources|null
     */
    public function getParent(): ?Resources
    {
        return $this->parent;
    }

    /**
     * @param Resources $parent
     */
    public function setParent(?Resources $parent): void
    {
        $this->parent = $parent;
        $this->setDeep($parent ? $parent->getDeep() : 0);
    }

    /**
     * @return Resources[]|ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Resources[]|ArrayCollection $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }
    abstract public function setDeep(int $deep) : void;
}
