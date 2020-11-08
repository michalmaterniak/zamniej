<?php
namespace App\Entity\Entities\Sliders\Slides;

use App\Entity\Entities\Sliders\Slides;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SlidesProducts
 *
 * @ORM\Table(name="slides_products")
 * @ORM\Entity
 */
class SlidesProducts extends Slides
{
    /**
     * @return int
     * @Groups({"slider-admin", "resource"})
     */
    public function getType()
    {
        return 4;
    }
}
