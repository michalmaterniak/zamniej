<?php
namespace App\Entity\Entities\System;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\DataTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Contents
 * @ORM\Table(name="contents")
 * @ORM\Entity
 */
class Contents implements EntityInterface
{
    /**
     * @var int $idContent
     * @ORM\Column(name="id_content", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "offers-admin-listing"})
     */
    protected $idContent;

    /**
     * @var string $content
     * @ORM\Column(name="content", type="text", nullable=false)
     * @Groups({"resource", "resource-admin", "offers-admin-listing"})
     */
    protected $content = '';

    use DataTrait;

    /**
     * @return int
     */
    public function getIdContent(): int
    {
        return $this->idContent;
    }

    /**
     * @param int $idContent
     */
    public function setIdContent(int $idContent): void
    {
        $this->idContent = $idContent;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function __toString()
    {
        return $this->content;
    }

    /**
     * @param string|null $key
     * @return mixed
     * @Groups({"resource", "resource-admin", "offers-admin-listing"})
     */
    public function getExtra($key = null, $defaultEmpty = [])
    {
        return $this->getData($key, $defaultEmpty);
    }

    /**
     * @param $data
     * @param string|null $key
     */
    public function setExtra($data, ?string $key = null)
    {
        $this->setData($data, $key);
    }
}
