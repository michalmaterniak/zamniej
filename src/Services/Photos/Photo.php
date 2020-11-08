<?php
namespace App\Services\Photos;

use App\Entity\Entities\System\Files;
use App\Services\Photos\Modificators\ModifierImage;
use App\Services\Photos\Traits\PhotosCreateTrait;

class Photo
{
    /**
     * @var Files $photo
     */
    protected $photo;

    use PhotosCreateTrait;

    /**
     * @var ModifierImage $resizerPhoto
     */
    protected $modifierImage;

    public function __construct(ModifierImage $modifierImage)
    {
        $this->modifierImage = $modifierImage;
    }

    /**
     * @return Files
     */
    public function getPhoto(): Files
    {
        return $this->photo;
    }
    /**
     * @param Files $photo
     */
    public function setPhoto(Files $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @param string $typeMod
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return PhotoModify
     */
    public function getModifiedPhoto(string $typeMod, int $width, int $height, $options = [])
    {
        if (method_exists($this, $typeMod)) {
            return $this->$typeMod($width, $height, $options);
        } else {
            return new PhotoModify($this->photo, $this->photo->getPath());
        }
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function resize(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->resize($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function fit(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->fit($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function adaptive(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->adaptive($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function adaptiveResize(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->adaptiveResize($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function insertCenter(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->insertCenter($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }

    /**
     * @param int   $width
     * @param int   $height
     * @param array $options
     * @return PhotoModify
     */
    protected function crop(int $width, int $height, $options = [])
    {
        return new PhotoModify($this->photo, $this->modifierImage->crop($this->photo->getFolder(), $this->photo->getFile(), $width, $height, $options));
    }
}
