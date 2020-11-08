<?php
namespace App\Services\Seo\Parser;

use App\Services\Seo\SeoElements;

class SeoParser
{
    public function parseConfig(SeoElements $seoElements, string $config) : string
    {

        preg_match_all("/({{)(.*?)(}})/", $config, $matches);
        foreach ($matches[2] ?? [] as $key) {
            if ($seoElements->checkAvailableProperty($key)) {
                $field = $this->getProperty($seoElements->getResource(), $seoElements->getAvailableProperty($key));
                $config = str_replace("{{{$key}}}", "$field", $config);
            } else {
                $config = str_replace("{{{$key}}}", $key, $config);
            }
        }

        return $config;
    }
    private function getProperty($object, $key, $numberKey = 0)
    {
        if (!$object) {
            return '';
        }
        $keys = explode('.', $key);
        $method = 'get'.ucfirst($keys[$numberKey]);
        return is_scalar($object->$method()) ? $object->$method() : $this->getProperty($object->$method(), $key, $numberKey+1);
    }
}
