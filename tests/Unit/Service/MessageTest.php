<?php declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\DataTransferObject\TestDataProvider;
use App\Service\Message;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageTest extends TestCase
{
    public function testSend()
    {
        $messageBusStub = new class implements MessageBusInterface {
            public TestDataProvider $message;

            public function dispatch($message, array $stamps = []): Envelope
            {
                $this->message = $message;
                return new Envelope(new \stdClass());
            }
        };

        $message = new Message($messageBusStub);

        $testDataProvider = new TestDataProvider();
        $testDataProvider->setName('Unit');
        $testDataProvider->setIdent(132456);

        $message->send($testDataProvider);

        self::assertSame($messageBusStub->message->getIdent(), $testDataProvider->getIdent());
        self::assertSame($messageBusStub->message->getName(), $testDataProvider->getName());
    }
}
