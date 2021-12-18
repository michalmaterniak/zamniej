<?php

namespace App\Entity\Entities\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\Interfaces\OfferVoucherInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TradetrackerVouchers
 * @ORM\Table(name="tradetracker_vouchers")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerVouchersRepository")
 */
class TradetrackerVouchers extends TradetrackerOffers implements OfferVoucherInterface
{
    public function getCodeText(): string
    {
        return $this->getVoucherCode();
    }
}
