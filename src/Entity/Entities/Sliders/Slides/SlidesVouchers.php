<?php
namespace App\Entity\Entities\Sliders\Slides;

use App\Entity\Entities\Sliders\Slides;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SlidesVouchers
 *
 * @ORM\Table(name="slides_vouchers")
 * @ORM\Entity
 */
class SlidesVouchers extends Slides
{
    /**
     * @var string $code
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     * @Groups({"slider-admin", "resource"})
     */
    protected $code;

    /**
     * @return int
     * @Groups({"slider-admin", "resource"})
     */
    public function getType()
    {
        return 2;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
