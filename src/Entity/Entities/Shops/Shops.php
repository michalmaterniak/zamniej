<?php
namespace App\Entity\Entities\Shops;

use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Entity\Interfaces\ResourcesInterface;
use App\Entity\Traits\ResourcesTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Shops
 * @ORM\Table(name="shops")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\ShopsRepository")
 */
class Shops implements ResourcesInterface
{
    use ResourcesTrait;
    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $id;

    /**
     * @var ShopTags $tag
     * @ORM\ManyToOne (targetEntity="App\Entity\Entities\Shops\Tags\ShopTags")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id_tag", nullable=false)
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $tag;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
}
