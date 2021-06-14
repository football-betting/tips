<?php declare(strict_types=1);

namespace App\Messenger\Transport;

use App\DataTransferObject\RankingAllEventDataProvider;
use App\DataTransferObject\TipDataProvider;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\SentStamp;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface;

class JsonSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        if (!isset($encodedEnvelope['body'])) {
            throw new \LogicException('incorect message');
        }

        $data = json_decode($encodedEnvelope['body'], true);

        if (!isset($data['event'])) {
            throw new \LogicException('incorect message: event');
        }

        if ($data['event'] === "app.to.tip") {
            // schema validation
            $tipDataProvider = new TipDataProvider();
            $tipDataProvider->fromArray($data['data']);

            return new Envelope($tipDataProvider);
        }

        throw new \RuntimeException('Incorrect event: ' . $data['event']);
    }

    public function encode(Envelope $envelope): array
    {
        /** @var DataProviderInterface $message */
        $message = $envelope->getMessage();
        if (!$message instanceof DataProviderInterface) {
            throw new \RuntimeException('Message should be DataProviderInterface');
        }

        if (method_exists($message, 'getData')) {
            $eventMessage = [
                'data' => $message->toArray()['data'],
            ];
        } else {
            $eventMessage = [
                'data' => $message->toArray(),
            ];
        }

        if (method_exists($message, 'getEvent') && $message->hasEvent()) {
            $eventMessage['event'] = $message->getEvent();
        }

        $stamps = $envelope->all();
        foreach ($stamps as $stampList) {
            foreach ($stampList as $stamp) {
                if ($stamp instanceof SentStamp) {
                    $alias = $stamp->getSenderAlias();
                    if ($alias !== null) {
                        $eventMessage['event'] = $alias;
                    }
                }
            }
        }

        return [
            'body' => json_encode($eventMessage),
        ];
    }

}

