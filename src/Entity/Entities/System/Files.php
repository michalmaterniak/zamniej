<?php
namespace App\Entity\Entities\System;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\DataTrait;
use App\Entity\Traits\SettingsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Files
 * @ORM\Table(name="files")
 * @ORM\Entity
 */
class Files implements EntityInterface
{
    use SettingsTrait, DataTrait;

    public const PHOTO = 0;
    public const FILE = 1;
    /**
     * @var int
     * @ORM\Column(name="id_file", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    protected $idFile;

    /**
     * @var string $group
     * @ORM\Column(name="group_name", type="string", length=300, nullable=false)
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    protected $group;

    /**
     * @var string $file
     * @ORM\Column(name="file", type="string", length=300, nullable=false)
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    protected $file = '';

    /**
     * @var string $folder
     * @ORM\Column(name="folder", type="string", length=300, nullable=false)
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    protected $folder = '';

    /**
     * @var int $type
     * @ORM\Column(name="type", type="smallint", nullable=false)
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    protected $type = self::PHOTO;

    /**
     * @return int
     */
    public function getIdFile(): int
    {
        return $this->idFile;
    }

    /**
     * @param int $idFile
     */
    public function setIdFile(int $idFile): void
    {
        $this->idFile = $idFile;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * @param string $folder
     */
    public function setFolder(string $folder): void
    {
        $this->folder = $folder;
    }

    /**
     * @return string
     * @Groups({"resource", "resource-admin", "subpage", "resource-admin-listing-shops", "slider-admin"})
     */
    public function getPath() : string
    {
        return $this->folder.$this->file;
    }

    public function setPath(string $path)
    {
        $pathArray = explode('/', $path);
        $this->setFile($pathArray[array_key_last($pathArray)]);
        $pathArray[array_key_last($pathArray)] = '';
        $this->setFolder(implode('/', $pathArray));
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }
}
