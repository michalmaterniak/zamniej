<?php
namespace App\Application\Pages\Shop\Rating\Factory;

use App\Application\Pages\Shop\Rating\ShopRating;
use App\Application\Pages\Shop\Shop;
use Doctrine\ORM\EntityManagerInterface;

class FactoryRating
{

    /**
     * @var ShopRating $shopRating
     */
    protected $shopRating;
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(
        ShopRating              $shopRating,
        EntityManagerInterface  $entityManager
    ) {
        $this->shopRating =     $shopRating;
        $this->entityManager =  $entityManager;
    }

    public function addRating(Shop $shop, int $rating)
    {
        if ($rating < 1 || $rating > 5) {
            throw new \ErrorException('Ocena musi być pomiędzy 1, a 5');
        }

        $this->shopRating->setShop($shop);
        $newRating = round(($this->shopRating->getCount()*$this->shopRating->getRating() + $rating) / ($this->shopRating->getCount()+1), 1);

        $shop->getModelEntity()->getContent()->setExtra($this->shopRating->getCount()+1, 'details.rating.count');
        $shop->getModelEntity()->getContent()->setExtra($newRating, 'details.rating.rating');

        $this->entityManager->flush();
    }
}
