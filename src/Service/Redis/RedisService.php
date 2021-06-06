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
        $this->prefix = $redisFactory->getPrefix();
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

    public function get(string $key)
    {
        return $this->client->zrevrange($key, 0, 100);
    }

    public function getAllByUser(string $username): array
    {
        $keys = $this->getKeys($username.':*');
        foreach ($keys as $id => $key) {
           $keys[$id] = str_replace($this->prefix, '', $key);
        }
        return $this->client->mget($keys);
    }

    private function getKeys(string $pattern): array
    {
        return (array)$this->client->keys($pattern);
    }

    /**
     * @param string $key
     */
    public function deleteAll(): void
    {
        $keys = $this->getKeys('*');
        foreach ($keys as $id => $key) {
            $keys[$id] = str_replace($this->prefix, '', $key);
        }
        $this->client->del($keys);
    }
}


