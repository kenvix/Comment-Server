<?php
// +----------------------------------------------------------------------
// 通用缓存类
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class Cache{
    private $driver;
    private $pool;

    public function __construct() {
        $this->driver = ucwords(strtolower(CacheDriver));
        switch ($this->driver) {
            case 'Filesystem':
                $filesystemAdapter = new \League\Flysystem\Adapter\Local(CacheHost);
                $filesystem        = new \League\Flysystem\Filesystem($filesystemAdapter);
                $this->pool        = new \Cache\Adapter\Filesystem\FilesystemCachePool($filesystem);
                break;

            case 'Predis':
                $client         = new \Predis\Client('tcp://'.CacheHost.':'.CachePort);
                $this->pool     = new \Cache\Adapter\Predis\PredisCachePool($client);
                break;

            case 'Redis':
                $client = new \Redis();
                $client->connect(CacheHost,CachePort);
                $this->pool = new \Cache\Adapter\Redis\RedisCachePool($client);
                break;

            case 'Memcache':
                $client = new \Memcache();
                $client->connect(CacheHost, CachePort);
                $this->pool  = new \Cache\Adapter\Memcache\MemcacheCachePool($client);
                break;

            case 'Memcached':
                $client = new \Memcached();
                $client->addServer(CacheHost, CachePort);
                $this->pool  = new \Cache\Adapter\Memcached\MemcachedCachePool($client);
                break;

            case 'Apc':
                $this->pool = new \Cache\Adapter\Apc\ApcCachePool();
                break;

            default:
                throw new InvalidArgumentException('无效的缓存驱动。请检查配置文件config/cache.php');
                break;
        }
    }

    public function getPool() {
        return $this->pool;
    }

    /**
     * @param $k
     * @return \Cache\Adapter\Common\CacheItem|\Cache\Adapter\Common\PhpCacheItem
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getItem($k) {
        return $this->pool->getItem(CachePrefix . $k);
    }

    /**
     * @param $item
     * @return bool
     */
    public function save($item) {
        return $this->pool->save($item);
    }

    /**
     * @param $k
     * @return mixed|null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getValue($k) {
        return $this->getItem($k)->get();
    }

    /**
     * @param $k
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function contains($k) {
        return  $this->pool->hasItem(CachePrefix . $k);
    }


    /**
     * @param      $k
     * @param      $v
     * @param null $lifeTime
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function setValue($k, $v, $lifeTime = null) {
        if(is_null($lifeTime))
            return $this->pool->save($this->getItem($k)->set($v));
        else
            return $this->pool->save($this->getItem($k)->set($v)->expiresAfter($lifeTime));
    }

    /**
     * @param $k
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function delete($k) {
        return  $this->pool->deleteItem(CachePrefix . $k);
    }
}