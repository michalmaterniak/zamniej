<?php
namespace App\Services\Models\Traits;

use App\Services\Photos\Photo;

trait PhotoTrait
{
    /**
     * @var Photo $photoManager
     */
    protected $photoManager;

    /**
     * @param Photo $photoManager
     * @required
     */
    public function setPhotoManager(Photo $photoManager): void
    {
        $this->photoManager = $photoManager;
    }
}
