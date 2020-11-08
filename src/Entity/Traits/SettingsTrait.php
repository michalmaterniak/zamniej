<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 04.11.18
 * Time: 19:18
 */
namespace App\Entity\Traits;

use App\Entity\DataArray;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait SettingsTrait
{
    /**
     * @var array
     * @ORM\Column(name="settings", type="json", nullable=false)
     * @Groups({"edit"})
     */
    protected $settings = [];

    /**
     * @param string|null $key
     * @param array       $defaultEmptyReturn
     * @return array|mixed|null
     */
    public function getSettings(string $key = null, $defaultEmptyReturn = [])
    {
        return DataArray::getDataArray($this->settings, $key, $defaultEmptyReturn);
    }

    /**
     * @param mixed       $settings
     * @param string|null $key
     */
    public function setSettings($settings, string $key = null): void
    {
        DataArray::setDataArray($this->settings, $key, $settings);
    }
}
