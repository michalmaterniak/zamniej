<?php
namespace App\Services\Pages\Resource\Factory\Slug;

use App\Entity\Entities\Subpages\Subpages;
use App\Services\Pages\Resource\Factory\Slug\Interfaces\Sluggable;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Symfony\Component\String\Slugger\SluggerInterface;

class Slug implements Sluggable
{
    protected PartPathGenerator $partPathGenerator;

    /**
     * @var SluggerInterface $slugGenerator
     */
    protected $slugGenerator;

    public function __construct(
        PartPathGenerator       $partPathGenerator,
        SlugGenerator           $slugGenerator
    ) {
        $this->partPathGenerator =      $partPathGenerator;
        $this->slugGenerator =          $slugGenerator;
    }


    public function slugGenerate(string $text)
    {
        return strtolower($this->slugGenerator->slug($text));
    }

    public function slugGenerateLocale($text, $locale)
    {
        return $this->slugGenerator->slug($text, '-', $locale);
    }

    /**
     * @param Subpages    $subpage
     * @param string|null $text
     * @return string
     * @throws \ErrorException
     */
    public function slugGenerateSubpage(Subpages $subpage, string $text = null) : void
    {
        {
            $name =         $text ?: $subpage->getName();
        if (!$name) {
            throw new \ErrorException('Name have to set first');
        }

            $partPath =     $this->slugGenerateLocale($name, $subpage->getLocale());
            $slug =         $this->partPathGenerator->getConstPart($subpage).$partPath;
        if ($subpage->getResource()->getParent()) {
            if (!($subpageParent = $subpage->getResource()->getParent()->getSubpage($subpage->getLocale()))) {
                throw new \ErrorException('Parent\'s subpage is not found to generate slug. Please, create first');
            }
            $slug = $subpageParent->getSlug().'/'.$slug;
        }
            $subpage->setPath($partPath);
            $subpage->setSlug(preg_replace('/^\//', '', $slug));
        }
    }
}
