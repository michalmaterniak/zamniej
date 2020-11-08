<?php
namespace App\Services\Files\Path;

class UploadsFilesPath
{
    /**
     * @var array $fileUploadsPath
     */
    protected $fileUploadsPath;

    /**
     * @param array $fileUploadsPath
     */
    public function setFileUploadsPath(array $fileUploadsPath): void
    {
        $this->fileUploadsPath =            $fileUploadsPath;
    }
    /**
     * @return string
     */
    public function getRelativeUploadsPath(): string
    {
        return $this->fileUploadsPath['relative'];
    }

    /**
     * @return string
     */
    public function getAbsoluteUploadsPath(): string
    {
        return $this->fileUploadsPath['absolute'];
    }

    public function getPublicPath()
    {
        return $this->fileUploadsPath['public'];
    }

    public function getAbsoluteCachePath()
    {
        return $this->fileUploadsPath['cache']['absolute'];
    }
    public function getRelativeCachePath()
    {
        return $this->fileUploadsPath['cache']['relative'];
    }

    public function getTmpPath()
    {
        return $this->fileUploadsPath['tmp'];
    }
}
