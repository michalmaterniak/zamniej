<?php
namespace App\Services\Seo;

use App\Services\Pages\Resource\Resource as Resource;
use App\Services\Seo\Interfaces\SeoInterface;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class Seo implements SeoInterface
{
    /**
     * @var SeoElements $seoElements
     */
    protected $seoElements;

    public function __construct(SeoElements $seoElements)
    {
        $this->seoElements = $seoElements;
    }

    public function loadResource(Resource $resource)
    {
        $this->seoElements->loadResource($resource);
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getTitle() : string
    {
        return $this->seoElements->getTitle();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getHeader() : string
    {
        return $this->seoElements->getHeader();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getDescription() : string
    {
        return $this->seoElements->getDescription();
    }

    /**
     * @return string
     * @Groups({"seo", "resource-admin"})
     */
    public function getCanonical() : ?string
    {
        return $this->seoElements->getCanonical();
    }
}
