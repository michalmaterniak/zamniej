<?php
namespace App\Entity\Entities\Settings;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Traits\SettingsTrait;
use ArrayAccess;
use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="App\Repository\Repositories\Settings\SettingsRepository")
 */
class Settings implements ArrayAccess, EntityInterface
{

    use SettingsTrait;

    /**
     * @var string
     * @ORM\Column(name="id_setting", type="string", length=200, nullable=false)
     * @ORM\Id
     */
    protected $idSetting;

    /**
     * @var string $type
     * @ORM\Column(name="type", type="string", length=200, nullable=true)
     */
    protected $type;

    /**
     * @var string $target
     * @ORM\Column(name="target", type="string", length=200, nullable=true)
     */
    protected $target;

    public function __construct(string $id = null)
    {
        $this->idSetting = $id;
    }

    /**
     * @return string
     */
    public function getIdSetting(): string
    {
        return $this->idSetting;
    }

    /**
     * @param string $idSetting
     */
    public function setIdSetting(string $idSetting): void
    {
        $this->idSetting = $idSetting;
    }

    public function offsetExists($offset)
    {
        return isset($this->settings[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->settings[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        return $this->settings[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->settings[$offset]);
    }
}
