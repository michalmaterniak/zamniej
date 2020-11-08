<?php
namespace App\Entity\Entities\Shops\Opinions;

use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\IdentifyPersons;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ShopOpinions
 * @ORM\Table(name="shop_opinions")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Shops\Opinions\ShopOpinionsRepository")
 */
class ShopOpinions implements EntityInterface
{
    /**
     * @var int $idShopOpinion
     * @ORM\Column(name="id_shop_opinion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin"})
     */
    protected $idShopOpinion;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Assert\NotBlank(
     *     message = "Imię / Nazwa nie może być puste"
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Minimalna ilość znaków nazwy to {{ limit }}",
     *      maxMessage = "Maksymalna ilość znaków nazwy to {{ limit }}",
     *      allowEmptyString = false
     * )
     * @Groups({"resource", "resource-admin"})
     */
    protected $name;

    /**
     * @var string $comment
     * @ORM\Column(name="comment", type="text", nullable=false)
     * @Assert\Length(
     *      min = 0,
     *      max = 5000,
     *      minMessage = "Minimalna ilość znaków komentarza to {{ limit }}",
     *      maxMessage = "Maksymalna ilość znaków komentarza to {{ limit }}",
     *      allowEmptyString = true
     * )
     * @Groups({"resource", "resource-admin"})
     */
    protected $comment;

    /**
     * @var int|null $rating
     * @ORM\Column(name="rating", type="smallint", nullable=true)
     * @Groups({"resource", "resource-admin"})
     */
    protected $rating;

    /**
     * @var IdentifyPersons $identifyPerson
     * @ORM\OneToOne(targetEntity="App\Entity\Entities\System\IdentifyPersons", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(name="identify_person_id", referencedColumnName="id_identify_person", nullable=true)
     */
    protected $identifyPerson;

    /**
     * @var bool $accepted
     * @ORM\Column(name="accept", type="boolean", nullable=false)
     */
    protected $accepted = false;

    /**
     * @var bool $adminCreated
     * @ORM\Column(name="admin_created", type="boolean", nullable=false)
     */
    protected $adminCreated = false;

    /**
     * @var \DateTime $datetimeCreate
     * @ORM\Column(name="datetime_create", type="datetime", nullable=false)
     * @Groups({"resource", "resource-admin"})
     */
    protected $datetimeCreate;

    /**
     * @var Subpages $subpage
     * @ORM\ManyToOne(targetEntity="App\Entity\Entities\Subpages\Subpages")
     * @ORM\JoinColumn(name="subpage_id", referencedColumnName="id_subpage", nullable=false)
     */
    protected $subpage;

    /**
     * @var int $priority
     * @ORM\Column(name="priority", type="smallint", nullable=false)
     */
    protected $priority = 0;

    public function __construct(Subpages $subpage)
    {
        $this->datetimeCreate = new \DateTime();
        $this->subpage = $subpage;
    }

    /**
     * @return int
     */
    public function getIdShopOpinion(): int
    {
        return $this->idShopOpinion;
    }

    /**
     * @param int $idShopOpinion
     */
    public function setIdShopOpinion(int $idShopOpinion): void
    {
        $this->idShopOpinion = $idShopOpinion;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
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
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int|null $rating
     */
    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return IdentifyPersons
     */
    public function getIdentifyPerson(): IdentifyPersons
    {
        return $this->identifyPerson;
    }

    public function setIdentifyPerson()
    {
        $this->identifyPerson = new IdentifyPersons();
    }
    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     */
    public function setAccepted(bool $accepted): void
    {
        $this->accepted = $accepted;
    }

    /**
     * @return \DateTime
     */
    public function getDatetimeCreate(): \DateTime
    {
        return $this->datetimeCreate;
    }

    /**
     * @return bool
     */
    public function admin(): bool
    {
        return $this->adminCreated;
    }

    /**
     * @param bool $adminCreated
     */
    public function setAdminCreated(bool $adminCreated): void
    {
        $this->adminCreated = $adminCreated;
        if ($adminCreated === true) {
            $this->setAccepted(true);
        }
    }

    /**
     * @return Subpages
     */
    public function getSubpage() : Subpages
    {
        return $this->subpage;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @param int $priority
     */
    public function addPriority(int $priority = 1): void
    {
        $this->priority += $priority;
    }
}
