<?php
namespace App\Entity\Entities\Sliders;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Sliders
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     "0" = "App\Entity\Entities\Sliders\Sliders",
 * })
 * @ORM\Table(name="sliders")
 * @ORM\Entity
 */
class Sliders
{
    /**
     * @var int $idSlider
     * @ORM\Column(name="id_slider", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource-admin-listing", "slider-admin", "resource"})
     */
    protected $idSlider;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=100, nullable=false, unique=true)
     * @Groups({"resource-admin-listing", "slider-admin", "resource"})
     */
    protected $name;

    /**
     * @var Slides[]|ArrayCollection $slides
     * @ORM\OneToMany(targetEntity="App\Entity\Entities\Sliders\Slides", mappedBy="slider", cascade={"persist"})
     * @Groups({"slider-admin", "resource"})
     */
    protected $slides;

    /**
     * @var bool $active
     * @ORM\Column(name="active", type="boolean", nullable=false)
     * @Groups({"resource-admin-listing", "slider-admin", "resource"})
     */
    protected $active = true;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="string", length=300, nullable=false)
     * @Groups({"resource-admin-listing", "slider-admin", "resource"})
     */
    protected $description;

    public function __construct()
    {
        $this->slides = new ArrayCollection();
    }

    public function addSlide(Slides $slide)
    {
        $slide->setSlider($this);
    }

    /**
     * @return int
     */
    public function getIdSlider(): int
    {
        return $this->idSlider;
    }

    /**
     * @param int $idSlider
     */
    public function setIdSlider(int $idSlider): void
    {
        $this->idSlider = $idSlider;
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
     * @return Slides[]|ArrayCollection
     */
    public function getSlides()
    {
        return $this->slides;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
