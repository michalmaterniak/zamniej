<?php
namespace App\Services\System\Cache;

use App\Services\System\Cache\Redis\CacheRedis;

class CacheManager
{
    /**
     * @var Cache $cache
     */
    protected $cache;

    /**
     * @var bool $isEnabled
     */
    protected $isEnabled;

    public function __construct(bool $cacheEnable, CacheRedis $cacheRedis)
    {
        $this->cache =      $cacheRedis;
        $this->isEnabled =  $cacheEnable;
    }

    /**
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    public function isEnable()
    {
        return $this->isEnabled;
    }
}
