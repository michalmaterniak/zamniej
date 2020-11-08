<?php
namespace App\Services\Seo\Elements;

use App\Services\Seo\Parser\SeoParser;
use App\Services\Seo\SeoElements;

abstract class SeoTitle
{
    /**
     * @var SeoParser $seoParser
     */
    protected $seoParser;

    public function __construct(SeoParser $seoParser)
    {
        $this->seoParser = $seoParser;
    }

    public function getTitle(SeoElements $seoElements, string $config)
    {
        return $this->seoParser->parseConfig($seoElements, $config);
    }
}
