<?php
// +----------------------------------------------------------------------
// 通用缓存类
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class Cache {
    private static $driver;
    private static $pool;

    public function __construct() {
        if(!empty(static::$pool)) return;
        self::$driver = ucwords(strtolower(CacheDriver));
        switch (self::$driver) {
            case 'Filesystem':
                $filesystemAdapter = new \League\Flysystem\Adapter\Local(CacheHost);
                $filesystem        = new \League\Flysystem\Filesystem($filesystemAdapter);
                self::$pool        = new \Cache\Adapter\Filesystem\FilesystemCachePool($filesystem);
                break;

            case 'Predis':
                $client         = new \Predis\Client('tcp://'.CacheHost.':'.CachePort);
                self::$pool     = new \Cache\Adapter\Predis\PredisCachePool($client);
                break;

            case 'Redis':
                $client = new \Redis();
                $client->connect(CacheHost,CachePort);
                self::$pool = new \Cache\Adapter\Redis\RedisCachePool($client);
                break;

            case 'Memcache':
                $client = new \Memcache();
                $client->connect(CacheHost, CachePort);
                self::$pool  = new \Cache\Adapter\Memcache\MemcacheCachePool($client);
                break;

            case 'Memcached':
                $client = new \Memcached();
                $client->addServer(CacheHost, CachePort);
                self::$pool  = new \Cache\Adapter\Memcached\MemcachedCachePool($client);
                break;

            case 'Apc':
                self::$pool = new \Cache\Adapter\Apc\ApcCachePool();
                break;

            default:
                throw new InvalidArgumentException('无效的缓存驱动。请检查配置文件config/cache.php');
                break;
        }
    }

    public function getPool() {
        return self::$pool;
    }

    /**
     * @param $k
     * @return \Cache\Adapter\Common\CacheItem|\Cache\Adapter\Common\PhpCacheItem
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getItem($k) {
        return self::$pool->getItem(CachePrefix . $k);
    }

    /**
     * @param $item
     * @return bool
     */
    public function save($item) {
        return self::$pool->save($item);
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
     * @param      $k
     * @param      $defaultValue
     * @param null $expire
     * @return mixed|null|void
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getValueWithDefault($k, $defaultValue, $expire = null) {
        $v = $this->getItem($k)->get();
        if(!empty($v)) {
            return $v;
        } else {
            $this->setValue($k, $defaultValue, $expire);
            return $defaultValue;
        }
    }

    /**
     * @param $k
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function contains($k) {
        return  self::$pool->hasItem(CachePrefix . $k);
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
            return self::$pool->save($this->getItem($k)->set($v));
        else
            return self::$pool->save($this->getItem($k)->set($v)->expiresAfter($lifeTime));
    }

    /**
     * @param $k
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function delete($k) {
        return self::$pool->deleteItem(CachePrefix . $k);
    }

    /**
     * @param     $k
     * @param int $num
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function counterAdd($k, $num = 1) {
        return $this->setValue($k, $this->getValueWithDefault($k, 0) + $num);
    }
}