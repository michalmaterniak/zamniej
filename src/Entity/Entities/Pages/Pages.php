<?php
namespace App\Entity\Entities\Pages;

use App\Entity\Interfaces\ResourcesInterface;
use App\Entity\Traits\ResourcesTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Pages
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Pages\PagesRepository")
 */
class Pages implements ResourcesInterface
{
    use ResourcesTrait;

    /**
     * @var int $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
