<?php
namespace App\Services\Pages\Resource;

use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\Contents;
use App\Services\Pages\Resource\Resource as Resource;
use App\Services\Seo\Seo;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class ResourceSubpage
{
    /**
     * @var Resource $resource
     */
    protected $resource;
    /**
     * @var Subpages $subpageEntity
     */
    private $subpageEntity;

    /**
     * @var ResourceComponents $components
     */
    protected $components;

    /**
     * @var Seo $seo
     */
    protected $seo;

    /**
     * @var string $locale
     */
    protected $locale;

    public function __construct(ResourceComponents $components)
    {
        $this->components = $components;
    }

    public function loadSeo(Seo $seo)
    {
        $this->seo = $seo;
    }
    public function loadResource(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return Subpages
     * @Groups({"resource-admin-list", "resource-admin", "resource"})
     */
    public function getSubpage(): Subpages
    {
        return $this->subpageEntity;
    }

    /**
     * @param Subpages $subpageEntity
     */
    public function setSubpageEntity(Subpages $subpageEntity): void
    {
        $this->subpageEntity = $subpageEntity;
        $this->locale = $subpageEntity->getLocale();
    }

    /**
     * @return ResourceComponents
     */
    public function getComponents(): ResourceComponents
    {
        return $this->components;
    }

    /**
     * @return Seo
     * @Groups({"resource-admin", "resource"})
     */
    public function getSeo(): Seo
    {
        $this->seo->loadResource($this->resource);
        return $this->seo;
    }

    /**
     * @return Contents
     * @Groups({"resource-admin", "resource"})
     */
    public function getContent() : Contents
    {
        return $this->getSubpage()->getContent();
    }

    /**
     * @return string
     * @Groups({"resource"})
     */
    public function getSlug()
    {
        return $this->getComponents()->getRouter()->generate('page-pages-main',[
            'slug' => $this->getSubpage()->getSlug()
        ]);
    }

    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }

    public function getLocale()
    {
        return $this->locale;
    }
}
