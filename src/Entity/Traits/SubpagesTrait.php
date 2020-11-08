<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Subpages;
use App\Services\Pages\Resource\Factory\Slug\Interfaces\Sluggable;

trait SubpagesTrait
{
    protected $constParts = [];

    /**
     * @param string $locale
     * @return string
     */
    public function getPartConst(string $locale = null) : string
    {
        $locale = $locale ?: $this->getLocale();
        if(!$this->getResource()->getParent())
        {
            return (!empty($this->constParts) && !empty($this->constParts[$locale])) ? $this->constParts[$locale] : '';
        }
        return '';
    }

    /**
     * @param Sluggable $slugGenerator
     */
    public function generateSlug(Sluggable $slugGenerator)
    {
        $slugGenerator->slugGenerateSubpage($this->getInstance(), $this->getName(),);
    }

    abstract protected function getInstance() : Subpages;
    abstract public function getResource() : Resources;

    public function isEqual(Subpages $subpage) : bool
    {
        return $this->getIdSubpage() === $subpage->getIdSubpage();
    }
}
