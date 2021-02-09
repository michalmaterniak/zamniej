<?php

namespace App\Application\Affiliations\Interfaces\Urls;

interface UrlTrackingConverterInterface
{
    public function getUrl(string $subpage): ?string;
}
