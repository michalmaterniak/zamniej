<?php
namespace App\Entity\Entities\Sliders;

use App\Entity\DataArray;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\System\Files;
use App\Entity\Traits\DataTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Slides
 *
 * @ORM\Table(name="slides")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     0 = "App\Entity\Entities\Sliders\Slides",
 *     1 = "App\Entity\Entities\Sliders\Slides\SlidesPromotions",
 *     2 = "App\Entity\Entities\Sliders\Slides\SlidesVouchers",
 *     3 = "App\Entity\Entities\Sliders\Slides\SlidesBanners",
 *     4 = "App\Entity\Entities\Sliders\Slides\SlidesProducts"
 * })
 * @ORM\Entity
 */
class Slides
{
    /**
     * @var int $idSlide
     * @ORM\Column(name="id_slide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"slider-admin", "resource"})
     */
    protected $idSlide;

    /**
     * @var Sliders $slider
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Sliders\Sliders", inversedBy="slides", cascade={"persist"})
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id_slider", nullable=false)
     */
    protected $slider;

    /**
     * @var DateTime $datetimeFrom
     * @ORM\Column(name="datetime_from", type="datetime", nullable=false)
     * @Groups({"slider-admin", "resource"})
     */
    protected $datetimeFrom;

    /**
     * @var DateTime|null $datetimeTo
     * @ORM\Column(name="datetime_to", type="datetime", nullable=true)
     * @Groups({"slider-admin", "resource"})
     */
    protected $datetimeTo = null;

    /**
     * @var string $link
     * @ORM\Column(name="link", type="string", length=700, nullable=false)
     * @Groups({"slider-admin", "resource"})
     */
    protected $link;

    /**
     * @var string $content
     * @ORM\Column(name="content", type="text", nullable=false)
     * @Groups({"slider-admin", "resource"})
     */
    protected $content;

    /**
     * @var string $header
     * @ORM\Column(name="header", type="string", length=700, nullable=false)
     * @Groups({"slider-admin", "resource"})
     */
    protected $header;

    /**
     * @var Files $image
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\System\Files")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id_file", nullable=false)
     * @Groups({"slider-admin"})
     */
    protected $photo;

    /**
     * @var Offers $offer
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Shops\Offers\Offers")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id_offer", nullable=true, onDelete="SET NULL")
     * @Groups({"slider-admin", "resource"})
     */
    protected $offer;

    use DataTrait;

    /**
     * @return int
     * @Groups({"slider-admin", "resource"})
     */
    public function getType()
    {
        return 0;
    }

    /**
     * @return int
     */
    public function getIdSlide(): int
    {
        return $this->idSlide;
    }

    /**
     * @param int $idSlide
     */
    public function setIdSlide(int $idSlide): void
    {
        $this->idSlide = $idSlide;
    }

    /**
     * @return Sliders
     */
    public function getSlider(): Sliders
    {
        return $this->slider;
    }

    /**
     * @param Sliders $slider
     */
    public function setSlider(Sliders $slider): void
    {
        $this->slider = $slider;
    }

    /**
     * @return DateTime
     */
    public function getDatetimeFrom(): DateTime
    {
        return $this->datetimeFrom;
    }

    /**
     * @param DateTime|string $datetimeFrom
     */
    public function setDatetimeFrom($datetimeFrom): void
    {
        if (is_string($datetimeFrom)) {
            $this->datetimeFrom = new DateTime($datetimeFrom);
        } elseif ($datetimeFrom instanceof DateTime) {
            $this->datetimeFrom = $datetimeFrom;
        }
    }

    /**
     * @return DateTime|null
     */
    public function getDatetimeTo(): ?DateTime
    {
        return $this->datetimeTo;
    }

    /**
     * @param DateTime|string|null $datetimeTo
     */
    public function setDatetimeTo($datetimeTo): void
    {
        if (is_string($datetimeTo)) {
            $this->datetimeTo = new DateTime($datetimeTo);
        } elseif ($datetimeTo instanceof DateTime) {
            $this->datetimeTo = $datetimeTo;
        } elseif (is_null($datetimeTo)) {
            $this->datetimeTo = null;
        }
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    /**
     * @return Files
     */
    public function getPhoto(): Files
    {
        return $this->photo;
    }

    /**
     * @param Files $photo
     */
    public function setPhoto(Files $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @param $data
     * @param string|null $key
     * @Groups({"slider-admin", "resource"})
     */
    public function setExtra($data, ?string $key = null)
    {
        DataArray::setDataArray($this->data, $key, $data);
    }

    public function getExtra(?string $key = null, $defaultEmpty = null)
    {
        return DataArray::getDataArray($this->data, $key, $defaultEmpty);
    }

    /**
     * @return Offers
     */
    public function getOffer(): Offers
    {
        return $this->offer;
    }

    /**
     * @param Offers $offer
     */
    public function setOffer(Offers $offer): void
    {
        $this->offer = $offer;
    }
}
