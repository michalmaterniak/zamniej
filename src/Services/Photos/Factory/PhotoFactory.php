<?php
namespace App\Services\Photos\Factory;

use App\Entity\Entities\System\Files;

class PhotoFactory
{
    /**
     * @var Files|null $photo
     */
    protected $photo;
    public function setPhoto(?Files $photo)
    {
        $this->photo = $photo;
    }
}
