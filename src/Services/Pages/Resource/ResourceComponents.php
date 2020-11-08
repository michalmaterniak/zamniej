<?php
namespace App\Services\Pages\Resource;

use App\Repository\Repositories\Subpages\CustomResourceRepository;
use App\Repository\Repositories\Subpages\PageResourceRepository;
use App\Repository\Repositories\Subpages\ResourcesRepository;
use App\Services\Components\Components;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Pages\Resource\Remove\ResourceRemove;
use App\Services\Pages\ResourcesManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;

abstract class ResourceComponents extends Components
{
    /**
     * @var ResourceFactory $resourceFactory
     */
    protected $resourceFactory;

    /**
     * @var ResourcesManager $resourceManager
     */
    protected $resourceManager;

    /**
     * @var RouterInterface $router
     */
    protected $router;

    /**
     * @var ResourceConfig $resourceConfig
     */
    protected $resourceConfig;

    /**
     * @var ResourcesRepository $resourceRepository
     */
    protected $resourceRepository;

    /**
     * @var CustomResourceRepository $customRepository
     */
    protected $customRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var PageResourceRepository $pageResourceRepository
     */
    protected $pageResourceRepository;

    /**
     * @var ResourceRemove $resourceRemove
     */
    protected $resourceRemove;

    public function __construct(
        CustomResourceRepository $customRepository,
        ResourceConfig $resourceConfig,
        ResourceFactory $resourceFactory,
        RouterInterface $router
    )
    {
        $this->customRepository = $customRepository;
        $this->resourceConfig = $resourceConfig;
        $this->resourceFactory = $resourceFactory;
        $this->router = $router;
    }

    /**
     * @return ResourceFactory
     */
    public function getResourceFactory(): ResourceFactory
    {
        return $this->resourceFactory;
    }

    /**
     * @return ResourcesManager
     */
    abstract public function getResourcesManager(): ResourcesManager;


    /**
     * @param ResourcesRepository $resourceRepository
     * @required
     */
    public function setResourceRepository(ResourcesRepository $resourceRepository): void
    {
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * @return ResourcesRepository
     */
    public function getResourceRepository(): ResourcesRepository
    {
        return $this->resourceRepository;
    }


    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * @return ResourceConfig
     */
    public function getResourceConfig(): ResourceConfig
    {
        return $this->resourceConfig;
    }

    /**
     * @return CustomResourceRepository
     */
    public function getCustomRepository()
    {
        return $this->customRepository;
    }

    public function getEntityManager() : EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @required
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return PageResourceRepository
     */
    public function getPageResourceRepository(): PageResourceRepository
    {
        return $this->entityManager->getRepository(
            $this->getResourceConfig()->getEntityClass()
        );
    }

    /**
     * @param ResourceRemove $resourceRemove
     * @required
     */
    public function setResourceRemove(ResourceRemove $resourceRemove): void
    {
        $this->resourceRemove = $resourceRemove;
    }

    /**
     * @return ResourceRemove
     */
    public function getResourceRemove(): ResourceRemove
    {
        return $this->resourceRemove;
    }
}
