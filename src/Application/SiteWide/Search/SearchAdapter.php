<?php

namespace App\Application\SiteWide\Search;

use App\Application\Pages\Shop\Shop;
use Doctrine\Common\Collections\ArrayCollection;

class SearchAdapter
{
    /**
     * @param ArrayCollection|Shop[] $shopsCollection
     */
    public function getSearchShops(ArrayCollection $shopsCollection)
    {
        $shops = new ArrayCollection();
        foreach ($shopsCollection as $shop) {
            $shops->add($this->getSearchShop($shop));
        }

        return $shops;
    }

    /**
     * @param Shop $shop
     */
    public function getSearchShop(Shop $shop)
    {
        return [
            'id' => $shop->getSubpage()->getSubpage()->getIdSubpage(),
            'name' => $shop->getSubpage()->getSubpage()->getName(),
            'logo' => $shop->getSubpage()->getPhoto()->getModifiedPhoto('insertCenter', 262, 116, ['background' => '#ffffff', 'margin-horizontal' => 40, 'margin-vertical' => 20]),
            'slug' => $shop->getSubpage()->getSlug()
        ];
    }
}
