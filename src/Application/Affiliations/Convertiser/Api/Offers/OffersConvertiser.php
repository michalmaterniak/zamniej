<?php

namespace App\Application\Affiliations\Convertiser\Api\Offers;

use App\Application\Affiliations\Convertiser\Api\Convertiser;
use Doctrine\Common\Collections\ArrayCollection;

class OffersConvertiser extends Convertiser
{
    /**
     * @var ArrayCollection $promotions
     */
    protected $promotions;

    /**
     * @return ArrayCollection
     */
    public function getPromotions(): ArrayCollection
    {
        if (!$this->promotions) {
            $promotions = [];
            $url = $this->getUrl();

            do {
                $data = $this->getResponse(['url' => $url]);
                $promotions = array_merge($promotions, $data['results']);
                $url = $data['next'];
            } while ($url);

            $this->promotions = new ArrayCollection($promotions);
        }

        return $this->promotions;
    }

    public function getPromotionsProgram(string $offer)
    {
        return $this->getPromotions()->filter(function ($object) use ($offer) {
            return $offer === $object['offer'];
        });
    }

    protected function getUrl(): string
    {
        return '/publisher/coupons/';
    }
}
