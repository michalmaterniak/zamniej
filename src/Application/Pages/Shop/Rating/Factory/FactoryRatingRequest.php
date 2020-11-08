<?php
namespace App\Application\Pages\Shop\Rating\Factory;

use App\Application\Pages\Shop\Rating\ShopRating;
use App\Application\Pages\Shop\Shop;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;

class FactoryRatingRequest extends FactoryRating
{
    /**
     * @var RequestPostContentData $requestPostContentData
     */
    protected $requestPostContentData;

    public function __construct(
        RequestPostContentData      $requestPostContentData,
        ShopRating                  $shopRating,
        EntityManagerInterface      $entityManager
    ) {
        parent::__construct($shopRating, $entityManager);
        $this->requestPostContentData = $requestPostContentData;
    }

    public function addRatingRequest(Shop $shop)
    {
        if (!$this->requestPostContentData->checkIfExist('rating')) {
            throw new \ErrorException('Błąd podczas zapisu');
        }

        $rating = $this->requestPostContentData->getValue('rating');
        $this->addRating($shop, $rating);
    }
}
