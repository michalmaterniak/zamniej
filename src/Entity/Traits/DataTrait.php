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

trait DataTrait
{
    /**
     * @var array
     * @ORM\Column(name="data", type="json", nullable=false)
     * @Groups({"resource", "resource-admin", "offers-admin-listing"})
     */
    protected $data = [];

    /**
     * @param string|null $key
     * @param null        $defaultEmpty
     * @return array|mixed|null
     */
    public function getData(string $key = null, $defaultEmpty = null)
    {
        return DataArray::getDataArray($this->data, $key, $defaultEmpty);
    }

    /**
     * @param mixed       $data
     * @param string|null $key
     */
    public function setData($data, string $key = null): void
    {

        DataArray::setDataArray($this->data, $key, $data);
    }
}
