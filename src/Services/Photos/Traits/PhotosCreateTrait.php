<?php
namespace App\Services\Photos\Traits;

use App\Entity\Entities\System\Files;
use App\Services\Photos\Photo;
use Doctrine\Common\Collections\ArrayCollection;

trait PhotosCreateTrait
{

    /**
     * @param ArrayCollection|Files[] $photos
     */
    public function createModelsPhotos($photos)
    {
        $photosModel = new ArrayCollection();
        foreach ($photos as $photo) {
            $photoModel = $this->createModelPhoto($photo);

            $photosModel->add($photoModel);
        }

        return $photosModel;
    }

    /**
     * @param Files|null $photo
     * @return Photo
     */
    public function createModelPhoto(?Files $photo)
    {
        /**
         * @var Photo $photoModel
         */
        $photoModel = clone $this;
        $photoModel->setPhoto($photo);

        return $photoModel;
    }
    abstract public function setPhoto(Files $photo);
}
