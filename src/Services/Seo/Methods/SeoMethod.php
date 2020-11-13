<?php

namespace App\Services\Seo\Methods;

/**
 * Class SeoMethod
 * @package App\Services\Seo\Parser\Methods
 */
abstract class SeoMethod
{
    abstract public function getName(): string;

    abstract public function getValue($value = null): string;
}
