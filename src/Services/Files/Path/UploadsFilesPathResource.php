<?php
namespace App\Services\Files\Path;

use App\Entity\Entities\Subpages\Resources;
use App\Services\Subpages\SlugGenerator\SlugGenerator;

class UploadsFilesPathResource
{
    /**
     * @var UploadsFilesPath $uploadPath
     */
    protected $uploadPath;

    /**
     * @var SlugGenerator $nameConverter
     */
    protected $nameConverter;
    public function __construct(
        UploadsFilesPath $uploadsFilesPath,
        SlugGenerator $nameConverter
    ) {
        $this->uploadPath = $uploadsFilesPath;
        $this->nameConverter = $nameConverter;
    }
    public function getAbsoluteUploadsPathResource(Resources $resource)
    {
        return $this->uploadPath->getAbsoluteUploadsPath().'resources/'.$resource->getConfig()->getSlug().'/';
    }

    public function getRelativeUploadsPathResource(Resources $resource)
    {

        return $this->uploadPath->getRelativeUploadsPath().'resources/'.$resource->getConfig()->getSlug().'/';
    }

    public function getAbsoluteCachePath()
    {
        return $this->uploadPath->getAbsoluteCachePath();
    }
    public function getRelativeCachePath()
    {
        return $this->uploadPath->getRelativeCachePath();
    }
}
