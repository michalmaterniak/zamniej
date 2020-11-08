<?php
namespace App\Entity\Traits;

use App\Entity\Entities\Subpages\Subpages;
use Doctrine\Common\Collections\ArrayCollection;

trait TranslationResourceTrait
{
    /**
     * @var Subpages[]|ArrayCollection $translations
     */
    protected $translations;

    public function getTranslations($withoutLocale)
    {
        if (!$this->translations) {
            $this->translations = $this->getSubpages()->filter(function (Subpages $subpage) use ($withoutLocale) {
                return $subpage->getLocale() != $withoutLocale;
            });
        }

        return $this->translations;
    }
    abstract public function getSubpages() : ArrayCollection;
}
