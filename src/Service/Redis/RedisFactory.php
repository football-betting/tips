<?php declare(strict_types=1);

namespace App\Service\Redis;

use Predis\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class RedisFactory
{
    private string $prefix;
    private string $uri;

    private ?Client $client = null;

    /**
     * @param \Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params)
    {
        $this->uri = (string)$params->get('app.redis.uri');
        $this->prefix = (string)$params->get('app.env');
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client($this->uri, ['prefix' => $this->getPrefix()]);
        }
        return $this->client;
    }

    public function getPrefix(): string
    {
        return $this->prefix .':';
    }
}
