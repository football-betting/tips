<?php declare(strict_types=1);

namespace App\Tests\Integration\MessageHandler;

use App\DataTransferObject\TipDataProvider;
use App\DataTransferObject\TipEventDataProvider;
use App\MessageHandler\TipMessageHandler;
use App\Service\Redis\RedisService;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\Bridge\Redis\Transport\RedisTransport;
use Symfony\Component\Messenger\MessageBusInterface;

class MyMessageHandlerTest extends KernelTestCase
{
    private ?Connection $entityManager;

    private ?RedisService $redis;
    private CommandTester $commandTester;

    private MessageBusInterface $messageBus;
    private KernelInterface $appKernel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->appKernel = self::bootKernel();

        $this->entityManager = self::$container
            ->get('doctrine.dbal.default_connection');


        $this->handler = static::$container->get(\App\Messenger\TipMessageHandler::class);
        $this->redis = static::$container->get(RedisService::class);

        $application = new Application($this->appKernel);

        $command = $application->find('messenger:consume');
        $this->commandTester = new CommandTester($command);

    }

    protected function tearDown(): void
    {
        $this->entityManager->executeStatement('DELETE FROM messenger_messages');
        $this->redis->deleteAll();

        $this->entityManager->close();
        $this->entityManager = null;

        parent::tearDown();
    }

    public function test()
    {
        $handler = $this->handler;

        $tipDataProvider1 = new TipDataProvider();
        $tipDataProvider1->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider1->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider1->setUser('ninja');
        $tipDataProvider1->setTipTeam1(1);
        $tipDataProvider1->setTipTeam2(2);


        $handler($tipDataProvider1);


        $tipDataProvider2 = new TipDataProvider();
        $tipDataProvider2->setMatchId('2020-06-16:2100-PL-IT');
        $tipDataProvider2->setTipDatetime('2020-06-16 21:00');
        $tipDataProvider2->setUser('ninja');
        $tipDataProvider2->setTipTeam1(4);
        $tipDataProvider2->setTipTeam2(3);

        $handler($tipDataProvider2);

        $tipDataProvider3 = new TipDataProvider();
        $tipDataProvider3->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider3->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider3->setUser('rockstar');
        $tipDataProvider3->setTipTeam1(2);
        $tipDataProvider3->setTipTeam2(0);

        $handler($tipDataProvider3);

        $tipDataProvider4 = new TipDataProvider();
        $tipDataProvider4->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider4->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider4->setUser('ninja');
        $tipDataProvider4->setTipTeam1(5);
        $tipDataProvider4->setTipTeam2(4);

        $handler($tipDataProvider4);

        $messageInfo = $this->getMessageInfo();

        self::assertCount(4, $messageInfo);

        $tipDataProviderList = $this->getTipDataProviderList($messageInfo[0]);

        self::assertCount(1, $tipDataProviderList);

        self::assertSame($tipDataProvider1->getMatchId(), $tipDataProviderList[0]->getMatchId());
        self::assertSame($tipDataProvider1->getUser(), $tipDataProviderList[0]->getUser());
        self::assertSame($tipDataProvider1->getTipTeam1(), $tipDataProviderList[0]->getTipTeam1());
        self::assertSame($tipDataProvider1->getTipTeam2(), $tipDataProviderList[0]->getTipTeam2());

        $tipDataProviderList = $this->getTipDataProviderList($messageInfo[1]);

        self::assertCount(2, $tipDataProviderList);

        self::assertSame($tipDataProvider2->getMatchId(), $tipDataProviderList[0]->getMatchId());
        self::assertSame($tipDataProvider2->getUser(), $tipDataProviderList[0]->getUser());
        self::assertSame($tipDataProvider2->getTipTeam1(), $tipDataProviderList[0]->getTipTeam1());
        self::assertSame($tipDataProvider2->getTipTeam2(), $tipDataProviderList[0]->getTipTeam2());

        self::assertSame($tipDataProvider1->getMatchId(), $tipDataProviderList[1]->getMatchId());
        self::assertSame($tipDataProvider1->getUser(), $tipDataProviderList[1]->getUser());
        self::assertSame($tipDataProvider1->getTipTeam1(), $tipDataProviderList[1]->getTipTeam1());
        self::assertSame($tipDataProvider1->getTipTeam2(), $tipDataProviderList[1]->getTipTeam2());

        $tipDataProviderList = $this->getTipDataProviderList($messageInfo[2]);

        self::assertCount(1, $tipDataProviderList);

        self::assertSame($tipDataProvider3->getMatchId(), $tipDataProviderList[0]->getMatchId());
        self::assertSame($tipDataProvider3->getUser(), $tipDataProviderList[0]->getUser());
        self::assertSame($tipDataProvider3->getTipTeam1(), $tipDataProviderList[0]->getTipTeam1());
        self::assertSame($tipDataProvider3->getTipTeam2(), $tipDataProviderList[0]->getTipTeam2());

        $tipDataProviderList = $this->getTipDataProviderList($messageInfo[3]);

        self::assertCount(2, $tipDataProviderList);

        self::assertSame($tipDataProvider2->getMatchId(), $tipDataProviderList[0]->getMatchId());
        self::assertSame($tipDataProvider2->getUser(), $tipDataProviderList[0]->getUser());
        self::assertSame($tipDataProvider2->getTipTeam1(), $tipDataProviderList[0]->getTipTeam1());
        self::assertSame($tipDataProvider2->getTipTeam2(), $tipDataProviderList[0]->getTipTeam2());

        self::assertSame($tipDataProvider1->getMatchId(), $tipDataProviderList[1]->getMatchId());
        self::assertSame($tipDataProvider4->getMatchId(), $tipDataProviderList[1]->getMatchId());
        self::assertSame($tipDataProvider4->getUser(), $tipDataProviderList[1]->getUser());
        self::assertSame($tipDataProvider4->getTipTeam1(), $tipDataProviderList[1]->getTipTeam1());
        self::assertSame($tipDataProvider4->getTipTeam2(), $tipDataProviderList[1]->getTipTeam2());

    }

    protected function getMessageInfo(): array
    {
        $sql = "SELECT * FROM messenger_messages";
        $stmt = $this->entityManager->prepare($sql);
        return $stmt->executeQuery()->fetchAllAssociative();
    }

    /**
     * @param array $messageDetail
     *
     * @return \App\DataTransferObject\TipDataProvider[]
     */
    private function getTipDataProviderList(array $messageDetail): array
    {
        self::assertSame('test:tip.list.to.calculation', $messageDetail['queue_name']);

        $dataProvider = new TipEventDataProvider();
        $dataProvider->fromArray(json_decode($messageDetail['body'], true));

        $tipDataProviderList = [];
        foreach ($dataProvider->getData() as $json) {
            $tipDataProvider = new TipDataProvider();
            $tipDataProvider->fromArray(json_decode($json, true));
            $tipDataProviderList[] = $tipDataProvider;
        }
        return $tipDataProviderList;
    }

    private function callMessengerConsumeCommand(): void
    {
        $this->commandTester->execute([
            'receivers' => ['app.to.tip'], '--limit' => '1', '--time-limit' => 1,
        ]);
    }

}
