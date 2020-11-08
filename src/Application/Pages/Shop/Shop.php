<?php
namespace App\Application\Pages\Shop;

use App\Application\Pages\Shop\Rating\ShopRating;
use App\Entity\Entities\Shops\Shops;
use App\Repository\Repositories\Shops\ShopsRepository;
use App\Services\Pages\Resource\Resource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Shop
 * @package App\Application\Pages\Shop
 * @method Shop getEntityResource() : Shop
 * @method ShopsRepository getPageResourceRepository() : ShopsRepository
 * @method Shops getModelResource() : Shops
 * @method ShopComponents getComponents() : ResourceComponents
 * @method ShopSubpage getSubpage(string $locale = null)
 */
class Shop extends Resource
{
    /**
     * @var ShopRating|null $rating
     */
    private $rating;

    public function __construct(
        ShopSubpagesManager $resourceSubpagesManager,
        ShopComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }

    /**
     * @return array
     * @Groups("resource")
     */
    public function getRating()
    {
        if (!$this->rating) {
            $this->rating = $this->getComponents()->getRating()->load($this);
        }

        return [
                'rating' => $this->rating->getRating(),
                'count' => $this->rating->getCount(),
            ];
    }
}
