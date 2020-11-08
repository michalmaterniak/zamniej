<?php
namespace App\Services\System\Locale\Interfaces;

interface LocaleInterface
{
    public function getLocale() : string;
    public function __toString() : string;
}
