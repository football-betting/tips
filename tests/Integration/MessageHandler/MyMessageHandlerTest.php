<?php declare(strict_types=1);

namespace App\Tests\Integration\MessageHandler;

use App\DataTransferObject\TipDataProvider;
use App\MessageHandler\TipMessageHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MyMessageHandlerTest extends KernelTestCase
{
    private ?TipMessageHandler $myMessageHandler;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $this->myMessageHandler = self::$container->get(TipMessageHandler::class);
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

        $myMessageHanlder = $this->myMessageHandler;
        $myMessageHanlder($tipDataProvider);

        $tipDataProvider = new TipDataProvider();
        $tipDataProvider->setMatchId('2020-06-16:2100-PL-IT');
        $tipDataProvider->setTipDatetime('2020-06-16 21:00');
        $tipDataProvider->setUser('ninja');
        $tipDataProvider->setTipTeam1(4);
        $tipDataProvider->setTipTeam2(3);

        $myMessageHanlder = $this->myMessageHandler;
        $myMessageHanlder($tipDataProvider);

        $tipDataProvider = new TipDataProvider();
        $tipDataProvider->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider->setUser('rockstar');
        $tipDataProvider->setTipTeam1(2);
        $tipDataProvider->setTipTeam2(0);

        $myMessageHanlder = $this->myMessageHandler;
        $myMessageHanlder($tipDataProvider);

        $tipDataProvider = new TipDataProvider();
        $tipDataProvider->setMatchId('2020-06-16:2100-FR-DE');
        $tipDataProvider->setTipDatetime('2021-06-15 15:00');
        $tipDataProvider->setUser('ninja');
        $tipDataProvider->setTipTeam1(5);
        $tipDataProvider->setTipTeam2(4);

        $myMessageHanlder = $this->myMessageHandler;
        $myMessageHanlder($tipDataProvider);
    }


}
