<?php
namespace App\Services\Files\Uploads;

use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Files\Purge\DeleteTreeFolders;

class PurgeUploads extends DeleteTreeFolders
{
    /**
     * @var UploadsFilesPath $uploadsFilesPath
     */
    protected $uploadsFilesPath;

    public function __construct(UploadsFilesPath $uploadsFilesPath)
    {
        $this->uploadsFilesPath = $uploadsFilesPath;
    }

    public function purgeUploads()
    {
        if (file_exists($this->uploadsFilesPath->getAbsoluteUploadsPath())) {
            $this->delTree($this->uploadsFilesPath->getAbsoluteUploadsPath());
        }
        mkdir($this->uploadsFilesPath->getAbsoluteUploadsPath(), 0777);
    }
}
