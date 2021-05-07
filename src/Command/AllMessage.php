<?php declare(strict_types=1);

namespace App\Command;

use App\DataTransferObject\TestDataProvider;
use App\Service\Message;
use App\Service\Redis\RedisService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AllMessage extends Command
{
    protected static $defaultName = 'test:all:message';

    /**
     * @var \App\Service\Redis\RedisService
     */
    private RedisService $redisService;


    public function __construct(RedisService $redisService)
    {
        parent::__construct();
        $this->redisService = $redisService;
    }

    protected function configure(): void
    {
        $this->setDescription('Test message');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $infos = $this->redisService->getAll();
        /** @var string $item */
        foreach ($infos as $item) {
            $output->writeln($item);
        }

        return 0;
    }
}
