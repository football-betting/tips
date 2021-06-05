<?php declare(strict_types=1);

namespace App\Messenger;

use App\DataTransferObject\TipDataProvider;
use App\DataTransferObject\TipEventDataProvider;
use App\DataTransferObject\TipUserListDataProvider;
use App\Service\Redis\RedisService;
use Symfony\Component\Messenger\MessageBusInterface;

class TipMessageHandler
{
    private RedisService $redisService;
    private MessageBusInterface $messageBus;

    /**
     * @param \App\Service\Redis\RedisService $redisService
     */
    public function __construct(RedisService $redisService, MessageBusInterface $messageBus)
    {
        $this->redisService = $redisService;
        $this->messageBus = $messageBus;
    }

    public function __invoke(TipDataProvider $message)
    {
        $ident = $message->getUser() . ':' . $message->getMatchId();
        $this->redisService->set($ident, json_encode($message->toArray(), JSON_THROW_ON_ERROR));

        $userTips = $this->redisService->getAllByUser($message->getUser());

        $tipEventDataProvider = new TipEventDataProvider();
        $tipEventDataProvider->setData($userTips);

        $this->messageBus->dispatch($tipEventDataProvider);
    }
}
