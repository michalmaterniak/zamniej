<?php
namespace App\Entity\Entities\Affiliations;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\DataTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Affiliations
 * @ORM\Table(name="affiliations")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Affiliations\AffiliationsRepository")
 */
class Affiliations implements EntityInterface
{
    /**
     * @var int $idAffiliation
     * @ORM\Column(name="id_affiliation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"program-admin", "program-admin-list", "resource-admin"})
     */
    protected $idAffiliation;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Groups({"program-admin", "program-admin-list", "resource-admin"})
     */
    protected $name;

    use DataTrait;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getIdAffiliation(): int
    {
        return $this->idAffiliation;
    }

    /**
     * @param int $idAffiliation
     */
    public function setIdAffiliation(int $idAffiliation): void
    {
        $this->idAffiliation = $idAffiliation;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}
