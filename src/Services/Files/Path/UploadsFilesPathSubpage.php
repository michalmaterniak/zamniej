<?php
namespace App\Services\Files\Path;

use App\Entity\Entities\Subpages\Subpages;
use App\Services\Subpages\SlugGenerator\SlugGenerator;

class UploadsFilesPathSubpage extends UploadsFilesPathResource
{
    public function __construct(UploadsFilesPath $uploadsFilesPath, SlugGenerator $nameConverter)
    {
        parent::__construct($uploadsFilesPath, $nameConverter);
    }

    public function getAbsoluteUploadsPathSubpage(Subpages $subpage)
    {
        return $this->getAbsoluteUploadsPathResource($subpage->getResource()).$subpage->getLocale().'/';
    }

    public function getRelativeUploadsPathSubpage(Subpages $subpage)
    {
        return $this->getRelativeUploadsPathResource($subpage->getResource()).$subpage->getLocale().'/';
    }
}
