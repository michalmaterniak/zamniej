<?php
namespace App\Services\Pages\Resource;

use App\Services\Seo\Seo;
use App\Services\System\Locale\Interfaces\LocaleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Services\Pages\Resource\Resource as Resource;

abstract class ResourceSubpagesManager
{
    /**
     * @var LocaleInterface $locale
     */
    private $locale;

    /**
     * @var Resource $resource
     */
    private $resource;

    /**
     * @var ResourceSubpage $subpageResource
     */
    private $subpageResource;

    /**
     * @var ArrayCollection|ResourceSubpage[] $subpagesResource
     */
    private $subpagesResource;
    /**
     * @var Seo $seo
     */
    protected $seo;

    public function __construct(
        Seo $seo,
        ResourceSubpage $subpageResource,
        LocaleInterface $locale
    ) {
        $this->subpageResource = $subpageResource;
        $this->subpagesResource = new ArrayCollection();
        $this->seo = $seo;
        $this->locale = $locale;
    }

    protected function afterLoadResource(Resource $resource) :void
    {
    }

    /**
     * @param Resource $resource
     */
    public function loadResource(Resource $resource)
    {
        $this->resource = $resource;
        $this->setSubpagesResource();
        $this->afterLoadResource($resource);
    }

    /**
     * @param string|null $locale
     * @param false       $global
     * @return string
     */
    protected function getLocale(string $locale = null, $global = false) : string
    {
        return $global ? ($this->locale->getLocale()) : ($locale ?: $this->locale->getLocale());
    }

    protected function setSubpagesResource()
    {
        $this->subpagesResource = new ArrayCollection();

        foreach ($this->resource->getModelEntity()->getSubpages() as $subpage) {
            $model = clone $this->subpageResource;
            $model->setSubpageEntity($subpage);
            $model->loadSeo($this->getSeo());
            $model->loadResource($this->resource);
            $this->subpagesResource->set($model->getSubpage()->getLocale(), $model);
        }
    }

    /**
     * @return ResourceSubpage[]|ArrayCollection
     */
    public function getSubpages()
    {
        return $this->subpagesResource;
    }

    /**
     * @param string|null $locale
     * @return ResourceSubpage
     */
    public function getSubpage(string $locale = null) : ResourceSubpage
    {
        return $this->subpagesResource->get($this->getLocale($locale)) ?: $this->subpagesResource->get($this->getLocale($locale, true));
    }

    /**
     * @return Seo
     */
    public function getSeo(): Seo
    {
        return $this->seo;
    }

    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }
}
