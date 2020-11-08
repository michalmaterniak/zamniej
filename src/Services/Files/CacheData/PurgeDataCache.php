<?php
namespace App\Services\Files\CacheData;

use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Files\Purge\DeleteTreeFolders;

class PurgeDataCache extends DeleteTreeFolders
{
    /**
     * @var UploadsFilesPath $uploadsFilesPath
     */
    protected $uploadsFilesPath;

    public function __construct(UploadsFilesPath $uploadsFilesPath)
    {
        $this->uploadsFilesPath = $uploadsFilesPath;
    }

    public function purgeCache()
    {
        if (file_exists($this->uploadsFilesPath->getAbsoluteCachePath())) {
            $this->delTree($this->uploadsFilesPath->getAbsoluteCachePath());
        }
        mkdir($this->uploadsFilesPath->getAbsoluteCachePath(), 0777);
    }
}
