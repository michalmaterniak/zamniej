<?php
namespace App\Services\System\Cache\Redis;

use App\Services\System\Cache\Cache;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class CacheRedis extends Cache
{
    protected $container;

    /**
     * CacheRedis constructor.
     * @param CacheItemPoolInterface $clearer
     * @param TagAwareCacheInterface $tagAwareCache
     */
    public function __construct(
        CacheItemPoolInterface  $clearer,
        TagAwareCacheInterface $tagAwareCache
    ) {
        parent::__construct($clearer, $tagAwareCache);
    }
}
