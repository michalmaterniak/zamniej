<?php

namespace App\Command\Scripts;

use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Script20201129105110Command
 * dodanie do externalId zewnetrznego ID przed nalozeniem unique constraint
 * @package App\Command\Scripts
 */
class Script20201129105110Command extends Command
{
    protected static $defaultName = 'script:20201129105110';

    /**
     * @var ShopsAffiliationRepository $shopsAffiliationRepository
     */
    protected $shopsAffiliationRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(
        ShopsAffiliationRepository $shopsAffiliationRepository,
        EntityManagerInterface $entityManager,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->shopsAffiliationRepository = $shopsAffiliationRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Show resource\'s config')
            ->setHidden(true);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $shops = $this->shopsAffiliationRepository->select(false)->withoutExternalId()->getResults();
        foreach ($shops as $shop) {
            $shop->setExternalId($shop->getExternalId());
            $this->entityManager->flush();
        }
        return 0;
    }
}
