<?php
namespace App\Entity\Entities\Users;

use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Users\UsersRepository")
 *
 * @UniqueEntity(
 *     fields="email",
 *     message="Podany email jest już w użyciu"
 * )
 */
class Users implements UserInterface, EntityInterface
{
    /**
     * @var int
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"auth"})
     */
    protected $idUser;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=500, nullable=false, unique=true)
     * @Assert\NotBlank(
     *     message = "Email nie może być pusty"
     * )
     * @Assert\Email(
     *     message = "Email'{{ value }}' ma nieprawidłową wartość"
     * )
     * @Groups({"auth"})
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=200, nullable=false)
     * @Groups({"auth"})
     * @Assert\NotBlank(
     *     message = "Imię nie może być puste"
     * )
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=200, nullable=false)
     * @Groups({"auth"})
     * @Assert\NotBlank(
     *     message = "Nazwisko nie może być puste"
     * )
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=200, nullable=false)
     * @Assert\NotBlank(
     *     message = "Hasło nie może być puste"
     * )
     */
    protected $password;

    /**
     * @var bool $active
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = true;
    /**
     * @var bool $admin
     * @ORM\Column(name="admin", type="boolean", nullable=false)
     */
    protected $admin = false;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getRoles()
    {
        return $this->isActive() ? ['ROLE_ADMIN'] : [];
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }
}
