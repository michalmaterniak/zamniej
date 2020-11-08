<?php
namespace App\Application\Pages\Category\Factory\Slug;

use App\Entity\Entities\Subpages\Subpages;
use App\Services\Pages\Resource\Factory\Slug\Slug;

class SlugCategoryGenerator extends Slug
{
    protected $constPartFirst = [
        'pl' => 'kategorie',
    ];
    public function slugGenerateSubpage(Subpages $subpage, string $text = null): void
    {
        $name =         $text ?: $subpage->getName();
        if (!$name) {
            throw new \ErrorException('Name have to set first');
        }

        $partPath =     $this->slugGenerateLocale($name, $subpage->getLocale());
        $slug =         $this->constPartFirst[$subpage->getLocale()].'/'.$this->partPathGenerator->getConstPart($subpage).$partPath;

        $subpage->setPath($partPath);
        $subpage->setSlug(preg_replace('/^\//', '', $slug));
    }
}
