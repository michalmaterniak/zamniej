<?php
namespace App\Services\System\Cache;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

abstract class Cache
{
    /**
     * @var CacheItemPoolInterface $clearer
     */
    protected $clearer;


    protected $manager;

    /**
     * AbstractCache constructor.
     * @param CacheItemPoolInterface $clearer
     * @param TagAwareCacheInterface $tagAwareCache
     */
    public function __construct(CacheItemPoolInterface $clearer, TagAwareCacheInterface $tagAwareCache)
    {
        $this->clearer =    $clearer;
        $this->manager =    $tagAwareCache;
    }

    public function clearCache()
    {
        $this->clearer->clear();
    }

    /**
     * @param string $key
     * @throws InvalidArgumentException
     */
    public function deleteItem(string $key)
    {
        $this->clearer->deleteItem($key);
    }

    /**
     * @return TagAwareCacheInterface
     */
    public function getManager(): TagAwareCacheInterface
    {
        return $this->manager;
    }
}
