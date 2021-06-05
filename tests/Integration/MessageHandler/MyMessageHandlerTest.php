<?php declare(strict_types=1);

namespace App\Tests\Integration\MessageHandler;

use App\DataTransferObject\TipDataProvider;
use App\MessageHandler\TipMessageHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MyMessageHandlerTest extends KernelTestCase
{
    private CommandTester $commandTester;

    private MessageBusInterface $messageBus;
    private KernelInterface $appKernel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->appKernel = self::bootKernel();

        $this->messageBus = static::$container->get(MessageBusInterface::class);
        $this->handler = static::$container->get(\App\Messenger\TipMessageHandler::class);

        $application = new Application($this->appKernel);

        $command = $application->find('messenger:consume');
        $this->commandTester = new CommandTester($command);

    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test()
    {
        $tipDataProvider = new TipDataProvider();
        $tipDataProvider->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider->setUser('ninja');
        $tipDataProvider->setTipTeam1(1);
        $tipDataProvider->setTipTeam2(2);

        $handler = $this->handler;
        $handler($tipDataProvider);
//        $this->messageBus->dispatch($tipDataProvider);
//        $this->callMessengerConsumeCommand();
//
//        $tipDataProvider = new TipDataProvider();
//        $tipDataProvider->setMatchId('2020-06-16:2100-PL-IT');
//        $tipDataProvider->setTipDatetime('2020-06-16 21:00');
//        $tipDataProvider->setUser('ninja');
//        $tipDataProvider->setTipTeam1(4);
//        $tipDataProvider->setTipTeam2(3);
//
//        $myMessageHanlder = $this->myMessageHandler;
//        $myMessageHanlder($tipDataProvider);
//
//        $tipDataProvider = new TipDataProvider();
//        $tipDataProvider->setMatchId('2020-06-16:2100-FR-DE');
//        $tipDataProvider->setTipDatetime('2021-06-15 15:00');
//        $tipDataProvider->setUser('rockstar');
//        $tipDataProvider->setTipTeam1(2);
//        $tipDataProvider->setTipTeam2(0);
//
//        $myMessageHanlder = $this->myMessageHandler;
//        $myMessageHanlder($tipDataProvider);
//
//        $tipDataProvider = new TipDataProvider();
//        $tipDataProvider->setMatchId('2020-06-16:2100-FR-DE');
//        $tipDataProvider->setTipDatetime('2021-06-15 15:00');
//        $tipDataProvider->setUser('ninja');
//        $tipDataProvider->setTipTeam1(5);
//        $tipDataProvider->setTipTeam2(4);
//
//        $myMessageHanlder = $this->myMessageHandler;
//        $myMessageHanlder($tipDataProvider);
    }

    private function callMessengerConsumeCommand(): void
    {
        $this->commandTester->execute([
            'receivers' => ['app.to.tip'], '--limit' => '1', '--time-limit' => 1,
        ]);
    }

}
