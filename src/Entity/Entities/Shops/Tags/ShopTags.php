<?php
namespace App\Entity\Entities\Shops\Tags;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class TagsShop
 * @ORM\Table(name="shop_tags")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Tags\ShopTagsRepository")
 */
class ShopTags
{
    /**
     * @var int $idShopTag
     * @ORM\Column(name="id_tag", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource-admin"})
     */
    protected $idShopTag;

    /**
     * @var ShopTagsTranslate[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Entities\Shops\Tags\ShopTagsTranslate", indexBy="locale", mappedBy="tag", fetch="LAZY", cascade={"persist", "remove"})
     * @Groups({"resource-admin"})
     */
    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdShopTag(): int
    {
        return $this->idShopTag;
    }

    /**
     * @return ShopTagsTranslate[]|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $locale
     * @return ShopTagsTranslate|null
     */
    public function getTag(string $locale) : ?ShopTagsTranslate
    {
        return $this->getTags()->get($locale);
    }

    /**
     * @param string $tag
     * @param string $locale
     * @return ShopTagsTranslate
     */
    public function addTag(string $tag, string $locale) :ShopTagsTranslate
    {
        $newTag = new ShopTagsTranslate();
        $newTag->setName($tag);
        $newTag->setLocale($locale);
        $newTag->setTag($this);
        $this->getTags()->set($locale, $newTag);

        return $newTag;
    }
}
