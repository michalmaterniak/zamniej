<?php
namespace App\Entity\Entities\System;

use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IdentifyPersons
 * @ORM\Table(name="identify_persons")
 * @ORM\Entity
 */
class IdentifyPersons implements EntityInterface
{
    /**
     * @var int $idIdentifyPerson
     * @ORM\Column(name="id_identify_person", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idIdentifyPerson;

    /**
     * @var array $request
     * @ORM\Column(name="request", type="json", nullable=false)
     */
    protected $request;

    /**
     * @var \DateTime $datetimeCreate
     * @ORM\Column(name="datetime_create", type="datetime", nullable=false)
     */
    protected $datetimeCreate;

    public function __construct()
    {
        $this->datetimeCreate = new \DateTime();
    }

    /**
     * @return int
     */
    public function getIdIdentifyPerson(): int
    {
        return $this->idIdentifyPerson;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * @param array $request
     */
    public function setRequest(array $request): void
    {
        $this->request = $request;
    }

    /**
     * @return \DateTime
     */
    public function getDatetimeCreate(): \DateTime
    {
        return $this->datetimeCreate;
    }
}
