<?php
namespace App\Services\Admin\Form\Updater\Fields;

use App\Entity\Entities\Subpages\Resources;
use App\Services\Admin\Form\Updater\Fields\Interfaces\FiledResourceUpdater;
use App\Services\System\EntityServices\Updater\EntityUpdater;

class SimpleUpdater extends EntityUpdater implements FiledResourceUpdater
{
    public function save(Resources $resource, string $path, $value) : void
    {
    }

    public function save2(Resources $resource, array $properties)
    {
        $this->updateEntity($properties, $resource, true);
    }
}
