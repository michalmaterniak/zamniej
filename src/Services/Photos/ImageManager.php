<?php
namespace App\Services\Photos;

use App\Application\Files\OfferPath;
use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Subpages;
use App\Services\Files\Path\UploadsFilesPath;
use App\Services\Files\Path\UploadsFilesPathResource;
use App\Services\Files\Path\UploadsFilesPathSubpage;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\ImageManager as GlobalImageManager;

class ImageManager extends GlobalImageManager
{
    /**
     * @var UploadsFilesPath $uploadsPaths
     */
    protected $uploadsPaths;
    /**
     * @var UploadsFilesPathSubpage $uploaderSubpage
     */
    protected $uploaderSubpage;

    /**
     * @var UploadsFilesPathResource $uploaderResource
     */
    protected $uploaderResource;

    /**
     * @var OfferPath $offerPath
     */
    protected $offerPath;
    public function __construct(array $config = [])
    {
        $config['driver'] = 'imagick';
        parent::__construct($config);
    }

    /**
     * @param UploadsFilesPath $uploadsPaths
     * @required
     */
    public function setUploadsPaths(UploadsFilesPath $uploadsPaths): void
    {
        $this->uploadsPaths = $uploadsPaths;
    }
    /**
     * @param UploadsFilesPathResource $uploaderResource
     * @required
     */
    public function setUploaderResource(UploadsFilesPathResource $uploaderResource): void
    {
        $this->uploaderResource = $uploaderResource;
    }

    /**
     * @param UploadsFilesPathSubpage $uploaderSubpage
     * @required
     */
    public function setUploaderSubpage(UploadsFilesPathSubpage $uploaderSubpage): void
    {
        $this->uploaderSubpage = $uploaderSubpage;
    }

    /**
     * @param OfferPath $offerPath
     * @required
     */
    public function setOfferPath(OfferPath $offerPath): void
    {
        $this->offerPath = $offerPath;
    }

    protected function checkFolder($path)
    {
        if (!file_exists($path)) {
            try {
                mkdir($path, 0777, true);
            } catch (\Exception $exception) {
                throw new \ErrorException('Cannot create folder: '.$path);
            }
        }
    }

    /**
     * @param string $filepath
     * @return string
     */
    protected function findExtension(string $filepath) : string
    {
        $info = getimagesize($filepath);

        return image_type_to_extension($info[2]);
    }
    /**
     * @param Resources $resource
     * @param string    $data
     * @param string    $name
     * @return string|null
     */
    public function saveAsResource(Resources $resource, string $data, string $name) : ?string
    {
        try {
            return $this->uploaderResource->getRelativeUploadsPathResource($resource).$this->saveImage($data, $name, $this->uploaderResource->getAbsoluteUploadsPathResource($resource));
        } catch (NotReadableException $exception) {
            return null;
        }
    }

    /**
     * @param Subpages $subpage
     * @param $data
     * @param string   $name
     * @return string|null
     */
    public function saveAsSubpage(Subpages $subpage, $data, string $name) : ?string
    {
        try {
            return $this->uploaderSubpage->getRelativeUploadsPathSubpage($subpage).$this->saveImage($data, $name, $this->uploaderSubpage->getAbsoluteUploadsPathSubpage($subpage));
        } catch (NotReadableException $exception) {
            return null;
        }
    }

    /**
     * @param Subpages $subpage
     * @param $data
     * @param string   $name
     * @return string|null
     */
    public function saveTmp($data, string $name) : ?string
    {
        try {
            return $this->uploadsPaths->getTmpPath().$this->saveImage($data, $name, $this->uploadsPaths->getTmpPath());
        } catch (NotReadableException $exception) {
            return null;
        }
    }

    /**
     * @param string $data
     * @param string $nameDesc
     * @param $absPath
     * @return string
     * @throws \ErrorException
     */
    public function saveImage(string $data, string $nameDesc, $absPath) : string
    {
        $this->checkFolder($absPath);
        $image = $this->make($data);
        $extension = $image->extension ?: $this->findExtension($data);
        $filePath = $nameDesc.'.'.$extension;
        $image->save($absPath.$filePath);

        return $filePath;
    }
}
