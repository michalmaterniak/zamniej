<?php
namespace App\Entity\Entities\Sliders\Slides;

use App\Entity\Entities\Sliders\Slides;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SlidesPromotions
 *
 * @ORM\Table(name="slides_promotions")
 * @ORM\Entity
 */
class SlidesPromotions extends Slides
{
    /**
     * @return int
     * @Groups({"slider-admin", "resource"})
     */
    public function getType()
    {
        return 1;
    }
}
