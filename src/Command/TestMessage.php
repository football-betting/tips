<?php declare(strict_types=1);

namespace App\Command;

use App\DataTransferObject\TestDataProvider;
use App\Service\Message;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestMessage extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'test:message';

    /**
     * @var \App\Service\Message
     */
    private Message $message;

    /**
     * @param \App\Service\Message $message
     */
    public function __construct(Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    protected function configure(): void
    {
        $this->setDescription('Test message');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $testDataProvider = new TestDataProvider();

        $testDataProvider->setIdent(time());
        $testDataProvider->setName('Test: ' . time());

        $this->message->send($testDataProvider);

        return 0;
    }
}
