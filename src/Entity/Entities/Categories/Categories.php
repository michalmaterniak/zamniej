<?php
namespace App\Entity\Entities\Categories;

use App\Entity\Interfaces\ResourcesInterface;
use App\Entity\Traits\ResourcesTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Pages
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Categories\CategoriesRepository")
 */
class Categories implements ResourcesInterface
{
    use ResourcesTrait;

    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
}
