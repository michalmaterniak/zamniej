<?php

namespace App\Entity\Entities\Affiliations\Tradetracker;

use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TradetrackerPromotions
 * @ORM\Table(name="tradetracker_promotions")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerPromotionsRepository")
 */
class TradetrackerPromotions extends TradetrackerOffers implements OfferPromotionInterface
{
}
