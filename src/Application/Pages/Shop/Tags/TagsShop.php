<?php
namespace App\Application\Pages\Shop\Tags;

use App\Application\Pages\Shop\ShopSubpage;
use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Repository\Repositories\Shops\Tags\ShopTagsRepository;
use Doctrine\Common\Collections\ArrayCollection;

class TagsShop
{
    protected $defaultTags = [
        'pl' => 'kupony rabatowe i promocje',
    ];


    /**
     * @var ShopTags[]|ArrayCollection $tags
     */
    protected $tags;

    /**
     * @var ShopTagsRepository  $shopTagsRepository
     */
    protected $shopTagsRepository;

    public function __construct(
        ShopTagsRepository  $shopTagsRepository
    ) {
        $this->shopTagsRepository = $shopTagsRepository;
    }

    /**
     * @param int $id
     * @return ShopTags|null
     */
    public function findShopTag(int $id) : ?ShopTags
    {
        if (!$this->tags) {
            $this->tags = $this->shopTagsRepository->select()->findAllWithTags()->getResults();
        }
        $result = $this->tags->filter(function (ShopTags $tag) use ($id) {
            return $tag->getIdShopTag() === $id;
        })->first();

        return $result ?: null;
    }

    public function getTag(ShopSubpage $subpage): ?string
    {
        $tag = $this->findShopTag($subpage->getResource()->getModelResource()->getTag()->getIdShopTag());

        if ($tag) {
            return $tag->getTag($subpage->getSubpage()->getLocale());
        } else {
            return $this->defaultTags[$subpage->getSubpage()->getLocale()];
        }
    }
}
