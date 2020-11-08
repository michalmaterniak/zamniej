<?php
namespace App\Entity\Entities\Shops\Offers;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffersProduct
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Offers\OffersProductRepository")
 */
class OffersProduct extends Offers
{
    

    public function getPrice()
    {
        return $this->getData('price');
    }

    public function setPrice(float $price)
    {
        $this->setData($price, 'price');
    }

    public function getCutPrice()
    {
        return $this->getData('cutPrice');
    }

    public function setCutPrice(float $cutPrice)
    {
        $this->setData($cutPrice, 'cutPrice');
    }
}
