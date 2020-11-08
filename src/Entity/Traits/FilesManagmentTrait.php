<?php
namespace App\Entity\Traits;

use App\Entity\Entities\System\Files;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

trait FilesManagmentTrait
{

    public function addFile(Files $photo)
    {
        $this->getFiles()->add($photo);
    }

    /**
     * @param string $group
     * @return Files[]|ArrayCollection
     */
    public function getFilesByGroup(string $group)
    {
        return $this->getFiles()->filter(fn(Files $photo) => $photo->getGroup() === $group);
    }

    /**
     * @return ArrayCollection|Files[]
     */
    public function getPhotos()
    {
        return $this->getFiles()->filter(fn(Files $photo) => $photo->getType() === Files::PHOTO);
    }

    public function getPhotosByGroup(string $group)
    {
        return $this->getPhotos()->filter(fn(Files $photo) => $photo->getGroup() === $group);
    }

    /**
     * @param string $group
     * @return Files|null
     */
    public function getPhoto(string $group)
    {
        return $this->getPhotos()->filter(fn(Files $photo) => $photo->getGroup() === $group)->first() ?: null;
    }

    /**
     * @return ArrayCollection|Files[]
     */
    abstract public function getFiles();
}
