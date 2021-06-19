<?php
namespace App\Command\Scripts;

use App\Application\Pages\PagesManager;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Script20210530105110Command
 * zamiana treści w sklepach - usunięcie klas w nagłówkach
 * @package App\Command\Scripts
 */
class Script20210530105110Command extends Command
{
    protected static $defaultName = 'script:20210530105110';

    /**
     * @var ShopRepository $shopRepository
     */
    protected $shopRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    protected PagesManager $resourcesManager;

    public function __construct(
        PagesManager $resourcesManager,
        ShopRepository $shopRepository,
        EntityManagerInterface $entityManager,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->resourcesManager = $resourcesManager;
        $this->shopRepository = $shopRepository;
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
        foreach ($this->resourcesManager->loadShops(
            $this->shopRepository->select(false)->contentNotNull()->getResults()
        ) as $shop) {
            foreach ($shop->getSubpages() as $subpage) {
                $subpage->getContent()->setContent(
                    preg_replace('/\s*class="(.*)"\s*/m', '', $subpage->getContent()->getContent())
                );
                $this->entityManager->flush();
            }
        }
        return 0;
    }
}
