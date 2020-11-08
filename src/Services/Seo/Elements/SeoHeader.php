<?php
namespace App\Services\Seo\Elements;

use App\Services\Seo\Parser\SeoParser;
use App\Services\Seo\SeoElements;

abstract class SeoHeader
{
    /**
     * @var SeoParser $seoParser
     */
    protected $seoParser;

    public function __construct(SeoParser $seoParser)
    {
        $this->seoParser = $seoParser;
    }

    public function getHeader(SeoElements $seoElements, string $config)
    {
        return $this->seoParser->parseConfig($seoElements, $config);
    }
}
