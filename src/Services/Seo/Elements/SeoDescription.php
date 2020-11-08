<?php
namespace App\Services\Seo\Elements;

use App\Services\Seo\Parser\SeoParser;
use App\Services\Seo\SeoElements;

abstract class SeoDescription
{
    /**
     * @var SeoParser $seoParser
     */
    protected $seoParser;

    public function __construct(SeoParser $seoParser)
    {
        $this->seoParser = $seoParser;
    }

    public function getDescription(SeoElements $seoElements, string $config)
    {
        return $this->seoParser->parseConfig($seoElements, $config);
    }
}
