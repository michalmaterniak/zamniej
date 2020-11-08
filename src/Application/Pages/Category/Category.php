<?php
namespace App\Application\Pages\Category;

use App\Application\Pages\Shop\Shop;
use App\Services\Pages\Resource\Resource;
use App\Services\Photos\Photo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Category
 * @package App\Application\Pages\Category
 * @method CategoryComponents getComponents() : ResourceComponents
 * @method CategorySubpage getSubpage(string $locale = null) : ResourceSubpage
 */
class Category extends Resource
{
    /**
     * @var Photo $logo
     */
    protected $logo;
    /**
     * @var Shop[]|ArrayCollection
     */
    protected $shops;

    public function __construct(
        CategorySubpagesManager $resourceSubpagesManager,
        CategoryComponents $resourceComponents
    )
    {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }


    /**
     * @return Photo
     */
    public function getLogo()
    {
        if (!$this->logo) {
            $this->logo = $this->getComponents()->getPhoto()->createModelPhoto(
                $this->getModelEntity()->getPhoto('logo')
            );
        }

        return $this->logo;
    }

    /**
     * @return Shop[]|ArrayCollection
     */
    public function getShops()
    {
        if (!$this->shops) {
            $this->shops = $this->getComponents()->getResourcesManager()->loadShops(
                $this->getComponents()->getShopRepository()->select()->byParent(
                    $this->getModelEntity()
                )->listingCategory()->getResults()
            );
        }
        return $this->shops;
    }
}
