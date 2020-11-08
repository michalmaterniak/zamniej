<?php
namespace App\Services\Admin\Form\Updater\Fields\Complex;

use App\Entity\Entities\Subpages\Resources;
use App\Services\Admin\Form\Updater\Fields\Interfaces\FiledResourceUpdater;

class PhotoUpdater implements FiledResourceUpdater
{
    public function save(Resources $resource, string $path, $value) : void
    {
    }
}
