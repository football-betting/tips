<?php declare(strict_types=1);

namespace App\Service\Redis;

use Predis\Client;

final class RedisService
{
    /**
     * @var \Predis\Client
     */
    private Client $client;

    /**
     * @param \App\Service\Redis\RedisFactory $redisFactory
     */
    public function __construct(RedisFactory $redisFactory)
    {
        $this->client = $redisFactory->getClient();
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->client->set($key, $value);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->client->get($key);
    }

    public function getAll()
    {
        $allKeys = $this->client->keys('*');
        return $this->mget($allKeys);
    }

    /**
     * @param array $keys
     *
     * @return array
     */
    public function mget(array $keys)
    {
        return $this->client->mget($keys);
    }

    /**
     * @param string $key
     *
     * @return int
     */
    public function delete(string $key): int
    {
        return $this->client->del([$key]);
    }
}


