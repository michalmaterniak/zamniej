<?php
namespace App\Entity\Entities\Homepages;

use App\Entity\Interfaces\ResourcesInterface;
use App\Entity\Traits\ResourcesTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Homepages
 * @ORM\Table(name="homepages")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Homepages\HomepagesRepository")
 */
class Homepages implements ResourcesInterface
{
    use ResourcesTrait;

    /**
     * @var int $idHomepage
     * @ORM\Column(name="id_homepage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "resource-admin-list"})
     */
    protected $idHomepage;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * @return int
     */
    public function getIdHomepage(): int
    {
        return $this->idHomepage;
    }

    /**
     * @param int $idHomepage
     */
    public function setIdHomepage(int $idHomepage): void
    {
        $this->idHomepage = $idHomepage;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getIdHomepage();
    }
}
