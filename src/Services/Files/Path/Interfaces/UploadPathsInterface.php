<?php
namespace App\Services\Files\Path\Interfaces;

use App\Services\Files\Path\UploadsFilesPath;

interface UploadPathsInterface
{
    public function __construct(UploadsFilesPath $uploadsFilesPath);
}
