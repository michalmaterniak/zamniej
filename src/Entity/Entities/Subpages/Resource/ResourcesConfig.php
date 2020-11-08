<?php
namespace App\Entity\Entities\Subpages\Resource;

use App\Entity\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ResourcesConfig
 * @ORM\Table(name="resources_config")
 * @ORM\Entity
 */
class ResourcesConfig implements EntityInterface
{
    /**
     * @var int $idResourceAdmin
     * @ORM\Column(name="id_resource_admin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idResourceAdmin;

    /**
     * @var bool $editable
     * @ORM\Column(name="editable", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin-list"})
     */
    protected $editable = true;

    /**
     * @var bool $removable
     * @ORM\Column(name="removable", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin-list"})
     */
    protected $removable = true;

    /**
     * @var bool $unactivable
     * @ORM\Column(name="unactivable", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin-list"})
     */
    protected $unactivable = true;

    /**
     * @var bool $unactivable
     * @ORM\Column(name="final", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin-list"})
     */
    protected $final = false;

    /**
     * @var bool $hidden
     * @ORM\Column(name="hidden", type="boolean", nullable=false)
     * @Groups({"resource", "resource-admin-list"})
     */
    protected $hidden = false;

    /**
     * @var string $slug
     * @ORM\Column(name="slug", type="string", length=700, nullable=false)
     */
    protected $slug = '';

    /**
     * @return int
     */
    public function getIdResourceInfo(): int
    {
        return $this->idResourceAdmin;
    }

    /**
     * @param int $idResourceAdmin
     */
    public function setIdResourceAdmin(int $idResourceAdmin): void
    {
        $this->idResourceAdmin = $idResourceAdmin;
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->editable;
    }

    /**
     * @param bool $editable
     */
    public function setEditable(bool $editable): void
    {
        $this->editable = $editable;
    }

    /**
     * @return bool
     */
    public function isRemovable(): bool
    {
        return $this->removable;
    }

    /**
     * @param bool $removable
     */
    public function setRemovable(bool $removable): void
    {
        $this->removable = $removable;
    }

    /**
     * @return bool
     */
    public function isUnactivable(): bool
    {
        return $this->unactivable;
    }

    /**
     * @param bool $unactivable
     */
    public function setUnactivable(bool $unactivable): void
    {
        $this->unactivable = $unactivable;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }

    /**
     * @param bool $final
     */
    public function setFinal(bool $final): void
    {
        $this->final = $final;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
