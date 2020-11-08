<?php
namespace App\Entity\Entities\Sliders\Slides;

use App\Entity\Entities\Sliders\Slides;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SlidesBanners
 *
 * @ORM\Table(name="slides_banners")
 * @ORM\Entity
 */
class SlidesBanners extends Slides
{
    /**
     * @return int
     * @Groups({"slider-admin", "resource"})
     */
    public function getType()
    {
        return 3;
    }
}
