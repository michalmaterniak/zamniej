<?php

namespace App\Command;

use App\Entity\Entities\System\Contents;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var OffersRepository $offersRepository
     */
    protected $offersRepository;

    /**
     * @var Factory
     */
    protected $faker;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    /**
     * @param OffersRepository $offersRepository
     * @required
     */
    public function setOffersRepository(OffersRepository $offersRepository): void
    {
        $this->offersRepository = $offersRepository;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @required
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $this->faker = Factory::create('pl');
        $offers = $this->offersRepository->select()->getResults();

        foreach ($offers as $offer) {
            $offerCloned = clone $offer;
            $offerCloned->setContent(new Contents());
            $offerCloned->getContent()->setContent($this->faker->realText(rand(20, 500)));
            $this->entityManager->persist($offerCloned);
            $this->entityManager->flush();
        }

        dump('done ;)');

        return 0;
    }
}
