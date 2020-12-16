<?php
namespace App\Application\Sliders;

use App\Entity\Entities\Sliders\Slides;
use App\Services\Photos\Photo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

class Slide
{
    /**
     * @var Photo $photo
     */
    protected $photo;

    /**
     * @var Slides $slide
     */
    protected $slide;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }


    /**
     * @param Slides[] $slides
     * @return Slide[]|ArrayCollection
     */
    public function createSlides($slides)
    {
        $slidesModels = new ArrayCollection();
        foreach ($slides as $slide) {
            $slidesModels->add($this->createSlide($slide));
        }

        return $slidesModels;
    }

    /**
     * @param Slides $slide
     * @return Slide
     */
    public function createSlide(Slides $slide)
    {
        $slideModel = clone $this;
        $slideModel->setSlide($slide);

        return $slideModel;
    }

    protected function setSlide(Slides $slide)
    {
        $this->slide = $slide;
        $this->photo = $this->photo->createModelPhoto($slide->getPhoto());
    }

    /**
     * @return Photo
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }


    /**
     * @return Slides
     * @Groups({"resource"})
     */
    public function getSlide(): Slides
    {
        return $this->slide;
    }
}
