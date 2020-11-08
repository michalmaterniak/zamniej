<?php


namespace App\Services\Subpages\SlugGenerator;

use App\Entity\Entities\Subpages\Resources;
use Symfony\Component\String\AbstractUnicodeString;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;

class SlugGenerator extends AsciiSlugger implements SluggerInterface
{
    private function toLowercase(string $text) : UnicodeString
    {
        return u(strtolower($text));
    }

    public function slug(string $string, string $separator = '-', string $locale = null): AbstractUnicodeString
    {
        return $this->toLowercase(parent::slug($string, $separator, $locale));
    }
}
