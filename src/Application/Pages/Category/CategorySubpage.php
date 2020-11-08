<?php
namespace App\Application\Pages\Category;

use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Shops\ShopsRepository;
use App\Services\Pages\Resource\ResourceSubpage;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class CategorySubpage
 * @package App\Application\Pages\Category
 *
 * @method CategoryComponents getComponents()
 * @method Category getResource() : Resource
 */
class CategorySubpage extends ResourceSubpage
{
    /**
     * @var Subpages[]|ArrayCollection
     */
    protected $shops;
    /**
     * @var ShopsRepository $shopsRepository
     */
    protected $shopsRepository;

    public function __construct(CategoryComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return array
     * @Groups({"resource"})
     */
    public function getShopsListing()
    {
        $shopsListing = [];

        foreach ($this->getResource()->getShops() as $shop) {
            $shopsListing[] = [
                'name' => $shop->getSubpage()->getSubpage()->getName(),
                'slug' => $shop->getSubpage()->getSlug(),
                'logo' => $shop->getSubpage()->getPhoto()->getModifiedPhoto('insertCenter', 360, 360),
                'rating' => $shop->getRating(),
                'description' => $shop->getSubpage()->getSubpage()->getContent()->getExtra('description', ''),
            ];
        }
        return $shopsListing;
    }

//    /**
//     * @return ArrayCollection|Shop[]
//     * @Groups({"resource"})
//     */
//    public function getShops()
//    {
//        if (!$this->shops) {
//            $this->shops = new ArrayCollection();
//            /**
//             * @var Shop $shop
//             */
//            foreach ($this->getComponents()->getPagesManager()->loadEntities($this->shopsRepository->findChildrenByParentResource($this->getResource()->getResource())) as $shop) {
//                $logoShop = $this->getComponents()->getPhoto()->createModelPhoto($shop->getSubpage()->getSubpage()->getLogo());
//                $this->shops->add([
//                    'name'          => $shop->getSubpage()->getSubpage()->getName(),
//                    'logo'          => $logoShop->getModifiedPhoto('insertCenter', 360, 360),
//                    'slug'          => $shop->getSubpage()->getSlug(),
//                    'rating'        => $shop->getRating(),
//                    'description'   => $shop->getSubpage()->getSubpage()->getContent()->getExtra('description', ''),
//                    'idShop'        => $shop->getSubpage()->getSubpage()->getIdSubpage(),
//                    'urlTracking'   => $shop->getSubpage()->getUrlTracking(),
//                ]);
//            }
//        }
//
//        return $this->shops;
//    }
}
