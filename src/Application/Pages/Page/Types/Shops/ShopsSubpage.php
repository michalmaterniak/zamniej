<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Pages\Page\PageSubpage;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ShopsSubpage
 * @package App\Application\Pages\Page\Types\Shops
 * @method ShopsComponents getComponents() : ResourceComponents
 */
class ShopsSubpage extends PageSubpage
{
    /**
     * @var array
     */
    protected $shops;

    public function __construct(ShopsComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return array
     * @Groups({"resource"})
     */
    public function getShops()
    {
        if (!$this->shops) {
            $this->shops = new ArrayCollection();

            foreach ($this->getComponents()->getResourcesManager()->loadShops(
                $this->getComponents()->getShopRepository()->select()->letterRequest()->getResults()
            ) as $shop) {
                $this->shops->add([
                    'name' => $shop->getSubpage()->getSubpage()->getName(),
                    'slug' => $shop->getSubpage()->getSlug(),
                    'logo' => $shop->getSubpage()->getPhoto()->getModifiedPhoto('insertCenter', 360, 360),
                    'rating' => $shop->getRating(),
                    'description' => $shop->getSubpage()->getSubpage()->getContent()->getExtra('description', ''),
                    'idShop' => $shop->getSubpage()->getSubpage()->getIdSubpage(),
                ]);
            }
        }
        return $this->shops;
    }

}
