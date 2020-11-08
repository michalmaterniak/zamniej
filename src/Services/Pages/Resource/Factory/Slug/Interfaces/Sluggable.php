<?php
namespace App\Services\Pages\Resource\Factory\Slug\Interfaces;

use App\Entity\Entities\Subpages\Subpages;

interface Sluggable
{
    public function slugGenerate(string $text);
    public function slugGenerateSubpage(Subpages $subpage, string $text = null) : void;
}
