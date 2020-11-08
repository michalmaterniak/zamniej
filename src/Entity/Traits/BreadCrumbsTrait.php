<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Subpages\Resources;
use Doctrine\Common\Collections\ArrayCollection;

trait BreadCrumbsTrait
{
    /**
     * @return Resources[]|ArrayCollection
     */
    public function getBreadcrumbs()
    {
        $parents = [];
        $parent = $this;
        do {
            $parents[] = $parent;
        } while ($parent = $parent->getParent());

        return new ArrayCollection(array_reverse($parents));
    }
}
