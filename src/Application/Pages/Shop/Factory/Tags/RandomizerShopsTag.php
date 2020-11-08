<?php
namespace App\Application\Pages\Shop\Factory\Tags;

use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Repository\Repositories\Shops\Tags\ShopTagsRepository;
use Doctrine\Common\Collections\ArrayCollection;

class RandomizerShopsTag
{
    /**
     * @var ShopTags[]|ArrayCollection $tags
     */
    protected $tags;

    /**
     * @var ShopTagsRepository $shopTagsRespository
     */
    protected $shopTagsRespository;

    public function __construct(ShopTagsRepository $shopTagsRepository)
    {
        $this->shopTagsRespository = $shopTagsRepository;
    }

    /**
     * @return ShopTags[]|ArrayCollection
     */
    private function getTags()
    {
        if(!$this->tags)
            $this->tags = $this->shopTagsRespository->select()->findAllWithTags()->getResults();
        return $this->tags;
    }
    public function random() : ShopTags
    {
        if ($this->getTags()->count() == 0) {
            throw new \ErrorException('amount tags must be more than 0');
        }

        return $this->tags->get(rand(0, $this->tags->count()-1));
    }
}
