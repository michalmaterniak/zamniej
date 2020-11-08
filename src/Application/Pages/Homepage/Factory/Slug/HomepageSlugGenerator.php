<?php


namespace App\Application\Pages\Homepage\Factory\Slug;

use App\Entity\Entities\Subpages\Subpages;
use App\Services\Pages\Resource\Factory\Slug\Slug;

class HomepageSlugGenerator extends Slug
{
    public function slugGenerateSubpage(Subpages $subpage, string $text = null): void
    {
        $subpage->setSlug('');
        $subpage->setPath('');
    }
}
