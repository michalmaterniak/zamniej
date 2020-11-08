<?php

namespace App\Entity\Entities\Subpages\Subpage;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\DataTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Seo
 * @ORM\Table(name="seo_subpage")
 * @ORM\Entity
 */
class Seo implements EntityInterface
{
    /**
     * @var int $idSeo
     * @ORM\Column(name="id_seo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin"})
     */
    protected $idSeo;

    /**
     * @var string|null $title
     * @ORM\Column(name="title", type="string", length=500, nullable=true)
     * @Groups({"resource", "resource-admin"})
     */
    protected $title = null;

    /**
     * @var string|null $header
     * @ORM\Column(name="header", type="string", length=500, nullable=true)
     * @Groups({"resource", "resource-admin"})
     */
    protected $header = null;

    /**
     * @var string|null $description
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Groups({"resource", "resource-admin"})
     */
    protected $description = null;

    /**
     * @var string|null $canonical
     * @ORM\Column(name="canonical", type="string", length=500, nullable=true)
     * @Groups({"resource", "resource-admin"})
     */
    protected $canonical = null;

    use DataTrait;

    /**
     * @return int
     */
    public function getIdSeo(): int
    {
        return $this->idSeo;
    }

    /**
     * @param int $idSeo
     */
    public function setIdSeo(int $idSeo): void
    {
        $this->idSeo = $idSeo;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * @param string|null $header
     */
    public function setHeader(?string $header): void
    {
        $this->header = $header;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getCanonical(): ?string
    {
        return $this->canonical;
    }

    /**
     * @param string|null $canonical
     */
    public function setCanonical(?string $canonical): void
    {
        $this->canonical = $canonical;
    }
}
