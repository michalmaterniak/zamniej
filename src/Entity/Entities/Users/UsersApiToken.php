<?php
namespace App\Entity\Entities\Users;

use App\Entity\Interfaces\EntityInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersApiToken
 *
 * @ORM\Table(name="users_api_token")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Users\UsersApiTokenRepository")
 */
class UsersApiToken implements EntityInterface
{
    /**
     * @var int
     * @ORM\Column(name="id_token", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idToken;

    /**
     * @var string
     * @ORM\Column(name="token", type="string", length=600, nullable=false, unique=true)
     * @Groups({"auth"})
     */
    protected $token;

    /**
     * @var DateTime $expiredDatetime
     * @ORM\Column(name="datetime_expired", type="datetime", nullable=false)
     * @Groups({"auth"})
     */
    protected $expiredDatetime;

    /**
     * @var Users $user
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id_user", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     * @Groups({"auth"})
     */
    protected $ip;

    public function __construct()
    {

        $this->expiredDatetime = new DateTime('+5 hours');
    }

    /**
     * @return int
     */
    public function getIdToken(): int
    {
        return $this->idToken;
    }

    /**
     * @param int $idToken
     */
    public function setIdToken(int $idToken): void
    {
        $this->idToken = $idToken;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return DateTime
     */
    public function getExpiredDatetime(): DateTime
    {
        return $this->expiredDatetime;
    }

    /**
     * @param DateTime $expiredDatetime
     */
    public function setExpiredDatetime(DateTime $expiredDatetime): void
    {
        $this->expiredDatetime = $expiredDatetime;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser(Users $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }
}
