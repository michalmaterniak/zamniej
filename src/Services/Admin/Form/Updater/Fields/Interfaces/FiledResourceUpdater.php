<?php
namespace App\Services\Admin\Form\Updater\Fields\Interfaces;

use App\Entity\Entities\Subpages\Resources;

interface FiledResourceUpdater
{
    /**
     * @param Resources $resource
     * @param string    $path
     * @param $value
     * @return mixed
     */
    public function save(Resources $resource, string $path, $value) : void;
}
