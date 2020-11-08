<?php
namespace App\Services\Pages\Resource\Factory\Slug;

use App\Entity\Entities\Subpages\Subpages;
use ErrorException;

class PartPathGenerator
{
    public function getConstPart(Subpages $subpage, string $locale = null)
    {
        if ($locale && !$subpage->getLocale()) {
            throw new ErrorException('Locale have to set earlier');
        }

        $locale = $locale ?: $subpage->getLocale();

        return $subpage->getPartConst($locale);
    }
}
