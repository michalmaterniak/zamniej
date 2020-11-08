<?php
namespace App\Entity\Entities\Shops\Offers;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * OffersVoucher
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Offers\OffersProductRepository")
 */
class OffersVoucher extends Offers
{

    /**
     * @return string
     * @Groups({"resource","offers-admin-listing"})
     */
    public function getCode()
    {
        return $this->getData('code');
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->setData($code, 'code');
    }
}
