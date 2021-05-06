<?php declare(strict_types=1);

namespace App\MessageHandler;

use App\DataTransferObject\TestDataProvider;
use App\Service\Redis\RedisService;

class MyMessageHandler
{
    private RedisService $redisService;

    /**
     * @param \App\Service\Redis\RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    public function __invoke(TestDataProvider $message)
    {
        try {
            dump($message);
            $this->redisService->set((string)$message->getIdent(), json_encode($message->toArray(), JSON_THROW_ON_ERROR));
        } catch (\Throwable $e) {
            dump($e);
        }
    }
}
