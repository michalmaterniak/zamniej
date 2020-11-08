<?php
namespace App\Services\Photos\Modificators;

use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Photos\ImageManager;
use Intervention\Image\Image;

class ModifierImage
{
    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    /**
     * @var UploadsFilesPath $uploadsFilesPath
     */
    protected $uploadsFilesPath;

    /**
     * ModifierImage constructor.
     * @param ImageManager     $imageManager
     * @param UploadsFilesPath $uploadsFilesPath
     */
    public function __construct(
        ImageManager $imageManager,
        UploadsFilesPath $uploadsFilesPath
    ) {
        $this->imageManager = $imageManager;
        $this->uploadsFilesPath = $uploadsFilesPath;
    }
    protected function forceSave(array $options = []) : bool
    {
        return $this->getOption($options, 'force', false);
    }

    protected function getOption(array $options, string $key, $defaultEmpty = null)
    {
        if (!empty($options[$key])) {
            return $options[$key];
        } else {
            return $defaultEmpty;
        }
    }

    /**
     * @param string $folder
     */
    protected function checkFolder(string $folder)
    {
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    }

    /**
     * @param Image  $image
     * @param string $folder
     * @param string $newbasename
     */
    protected function savePhoto(Image $image, string $folder, string $newbasename)
    {
        $this->checkFolder($this->uploadsFilesPath->getAbsoluteCachePath().$folder);
        $image = $image->encode('webp', 75);
        $image->save($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename);
    }

    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @return string
     */
    public function resize(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $newbasename = 'resize_'.$width.'_'.$height.'_'.$filename.'.webp';

        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $image = $this->imageManager->make($this->uploadsFilesPath->getPublicPath().$filepath);
            $this->savePhoto($image->resize($width, $height), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }

    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return string
     */
    public function fit(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $newbasename = 'fit_'.$width.'_'.$height.'_'.$filename.'.webp';

        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $image = $this->imageManager->make($this->uploadsFilesPath->getPublicPath().$filepath);
            $this->savePhoto($image->fit($width, $height), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }


    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return string
     */
    public function adaptive(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $originalPath = $this->uploadsFilesPath->getPublicPath().$filepath;
        $newbasename = 'adaptive_'.$width.'_'.$height.'_'.$filename.'.webp';
        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $heightEmpty = $height;
            $widthEmpty = $width;

            if (!empty($options['add-height'])) {
                $heightEmpty = $height + $options['add-height'];
            }
            if (!empty($options['add-width'])) {
                $widthEmpty = $width + $options['add-width'];
            }

            $empty = $this->imageManager->canvas($widthEmpty, $heightEmpty);

            $image = $this->imageManager->make($originalPath);

            if ($image->width() > $image->height()) {
                $image = $image->widen($width);
            } else {
                $image = $image->heighten($height);
            }
            $position = !empty($options['position']) ? $options['position'] : 'top';

            $this->savePhoto($empty->insert($image, $position), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }


    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return string
     */
    public function insertCenter(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $originalPath = $this->uploadsFilesPath->getPublicPath().$filepath;
        $newbasename = 'insert-center'.$width.'_'.$height.'_'.$filename.'.webp';
        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $empty = $this->imageManager->canvas($width, $height, $this->getOption($options, 'background'));

            $image = $this->imageManager->make($originalPath);

            if ($image->width() > $empty->width()) {
                $image = $image->widen($width - ((int)$this->getOption($options, 'margin-horizontal', 0) * 2));
            }

            if ($image->height() > $empty->height()) {
                $image = $image->heighten($height - ((int)$this->getOption($options, 'margin-vertical', 0) * 2));
            }
            $this->savePhoto($empty->insert($image, 'center'), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }


    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return string
     */
    public function adaptiveResize(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $originalPath = $this->uploadsFilesPath->getPublicPath().$filepath;
        $newbasename = 'adaptive-resize_'.$width.'_'.$height.'_'.$filename.'.webp';
        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $heightEmpty = $height;
            $widthEmpty = $width;

            if (!empty($options['add-height'])) {
                $heightEmpty = $height + $options['add-height'];
            }
            if (!empty($options['add-width'])) {
                $widthEmpty = $width + $options['add-width'];
            }

            $empty = $this->imageManager->canvas($widthEmpty, $heightEmpty);


            $resizeHeight = $this->getOption($options, 'resize-height', 0);
            $resizeWidth = $this->getOption($options, 'resize-width', 0);

            $image = $this->imageManager->make($originalPath);

            $image = $image->resize($width+$resizeWidth, $height+$resizeHeight);

//            if($image->width() > $image->height() )
//            {
//                $image = $image->widen($width);
//            }
//            else
//            {
//                $image = $image->heighten($height);
//            }
            $position = !empty($options['position']) ? $options['position'] : 'top';

            $this->savePhoto($empty->insert($image, $position), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }

    /**
     * @param string $folder
     * @param string $filename
     * @param int    $width
     * @param int    $height
     * @param array  $options
     * @return string
     */
    public function crop(string $folder, string $filename, int $width, int $height, $options = []) : string
    {
        $filepath = $folder.$filename;
        $newbasename = 'crop_'.$width.'_'.$height.'_'.$filename.'.webp';

        if (!file_exists($this->uploadsFilesPath->getAbsoluteCachePath().$folder.$newbasename) || $this->forceSave($options)) {
            $image = $this->imageManager->make($this->uploadsFilesPath->getPublicPath().$filepath);
            $this->savePhoto($image->crop($width, $height), $folder, $newbasename);
        }

        return $this->uploadsFilesPath->getRelativeCachePath().$folder.$newbasename;
    }
}
