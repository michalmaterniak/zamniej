<?php

namespace App\Command\System;

use App\Services\Files\CacheData\PurgeDataCache;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PurgeDataCacheCommand extends Command
{
    protected static $defaultName = 'cache:data:clear';

    /**
     * @var PurgeDataCache $purgeDataCache
     */
    protected $purgeDataCache;
    public function __construct(PurgeDataCache $purgeDataCache, string $name = null)
    {
        parent::__construct($name);
        $this->purgeDataCache = $purgeDataCache;
    }

    protected function configure()
    {
        $this
            ->setDescription('Clearer thumbs - data cache')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->purgeDataCache->purgeCache();
        dump('done ;)');

        return 0;
    }
}
