<?php
namespace App\Application\Pages\Shop\Rating;

use App\Application\Pages\Shop\Shop;

class ShopRating
{
    /**
     * @var Shop $shop
     */
    protected $shop;

    public function load(Shop $shop)
    {
        $model = clone $this;
        $model->setShop($shop);

        return $model;
    }

    public function setShop(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return (int)$this->shop->getModelEntity()->getContent()->getExtra('details.rating.count', 1) ?: 1;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return (float)$this->shop->getModelEntity()->getContent()->getExtra('details.rating.rating', 4.5) ?: 4.5;
    }
}
