<?php
namespace App\Entity\Entities\Shops\Tags;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class TagsTranslate
 * @ORM\Table(name="shop_tags_translate",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="name_locale", columns={"name", "locale"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Tags\ShopTagsTranslateRepository")
 */
class ShopTagsTranslate
{
    /**
     * @var int $idTag
     * @ORM\Column(name="id_tag", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource-admin"})
     */
    protected $idTag;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Groups({"resource-admin"})
     */
    protected $name;

    /**
     * @var string $locale
     * @ORM\Column(name="locale", type="string", length=10, nullable=false)
     * @Groups({"resource-admin"})
     */
    protected $locale;

    /**
     * @var ShopTags $tag
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Shops\Tags\ShopTags", inversedBy="tags")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id_tag", nullable=false)
     */
    protected $tag;

    /**
     * @return int
     */
    public function getIdTag(): int
    {
        return $this->idTag;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return ShopTags
     */
    public function getTag(): ShopTags
    {
        return $this->tag;
    }

    /**
     * @param ShopTags $tag
     */
    public function setTag(ShopTags $tag): void
    {
        $this->tag = $tag;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
