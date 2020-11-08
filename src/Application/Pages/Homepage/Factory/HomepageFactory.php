<?php
namespace App\Application\Pages\Homepage\Factory;

use App\Application\Pages\Homepage\HomepageConfig;
use App\Entity\Entities\Homepages\Homepages;
use App\Entity\Interfaces\ResourcesInterface;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HomepageFactory
 * @package App\Application\Pages\Homepage\Factory
 */
class HomepageFactory extends ResourceFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        HomepageSubpageFactory $subpageFactory,
        HomepageConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }

    protected function beforeCreateResource(): void
    {
        $this->resetSlug();
    }
    protected function resetSlug()
    {
        $this->resourceCreate->getConfig()->setSlug('');
    }
    public function createHomepage() : self
    {
        $this->create('Strona główna');
        $this->save();

        return $this;
    }

    /**
     * @return Homepages|ResourcesInterface
     */
    public function getHomepage() : Homepages
    {
        return $this->pageCreate;
    }
}
