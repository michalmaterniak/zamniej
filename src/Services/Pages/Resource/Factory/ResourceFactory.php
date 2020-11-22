<?php
namespace App\Services\Pages\Resource\Factory;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Subpages;
use App\Entity\Entities\System\Files;
use App\Entity\Interfaces\ResourcesInterface;
use App\Services\Pages\Resource\ResourceConfig;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use App\Services\System\Factory\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

abstract class ResourceFactory extends Factory
{
    /**
     * @var ResourcesInterface $pageCreate
     */
    protected $pageCreate;

    /**
     * @var Resources $resourceCreate
     */
    protected $resourceCreate;

    /**
     * @var Subpages[] $subpageCreate
     */
    protected $subpagesCreate;

    /**
     * @var Subpages $currentSubpage
     */
    protected $currentSubpage;

    /**
     * @var ResourceConfig $resourceModelConfig
     */
    protected $resourceModelConfig;

    /**
     * @var SubpageFactory $subpageFactory
     */
    protected $subpageFactory;

    /**
     * @var array $data
     */
    protected $data;

    /**
     * @var SlugGenerator $slugGenerator
     */
    protected $slugGenerator;

    /**
     * ResourceFactory constructor.
     * @param EntityManagerInterface $entityManager
     * @param SubpageFactory $subpageFactory
     * @param ResourceConfig $resourceConfig
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SubpageFactory $subpageFactory,
        ResourceConfig $resourceConfig,
        SlugGenerator $slugGenerator
    )
    {
        parent::__construct($entityManager);
        $this->subpageFactory = $subpageFactory;
        $this->resourceModelConfig = $resourceConfig;
        $this->slugGenerator = $slugGenerator;
    }

    protected function afterCommit()
    {
    }

    protected function afterCreatePage(): void
    {
    }

    protected function beforeCreatePage(): void
    {
    }

    protected function afterCreateResource(): void
    {
    }

    protected function beforeCreateResource(): void
    {
    }

    protected function afterCreateSubpage(): void
    {
    }

    protected function beforeCreateSubpage(): void
    {
    }


    public function create(string $name, ?Resources $parent = null, array $data = []): self
    {
        $this->data = $data;
        $this->entityManager->beginTransaction();

        $this->createPage($name);
        $this->createResource($name, $parent);
        $this->addSubpage($this->resourceCreate, $name);

        return $this;
    }

    protected function createPage(string $name) : self
    {
        $class = $this->resourceModelConfig->getEntityClass();
        $this->pageCreate = new $class($name);

        $this->beforeCreatePage();

        $this->entityManager->persist($this->pageCreate);
        $this->entityManager->flush();

        $this->afterCreatePage();

        return $this;
    }

    protected function createResource(string $name, ?Resources $parent = null)
    {
        $this->resourceCreate = new Resources($name, $this->resourceModelConfig->getKey(), $this->pageCreate, $parent);
        $this->pageCreate->setResource($this->resourceCreate);

        $prefix = '';
        if($parent && $this->resourceCreate->getParent()->getConfig()->getSlug())
            $prefix = $this->resourceCreate->getParent()->getConfig()->getSlug() . '/';

        $this->resourceCreate->getConfig()->setSlug( $prefix . $this->slugGenerator->slug($this->resourceCreate->getName()));

        $this->beforeCreateResource();

        $this->entityManager->persist($this->resourceCreate);
        $this->entityManager->flush();

        $this->afterCreateResource();
    }

    /**
     * @param Resources   $resource
     * @param string      $name
     * @param string|null $locale
     * @return Subpages
     */
    public function addSubpage(Resources $resource, string $name, string $locale = null) : Subpages
    {
        $this->currentSubpage = $this->subpageFactory->factory($resource, $name, $locale);

        $this->beforeCreateSubpage();

        $this->entityManager->persist($this->currentSubpage);
        $this->entityManager->flush();

        $this->afterCreateSubpage();
        $this->subpagesCreate[$this->currentSubpage->getLocale()] = $this->currentSubpage;

        return $this->currentSubpage;
    }

    public function save()
    {
        try {
            $this->entityManager->getConnection()->commit();
            $this->afterCommit();

        } catch (Exception $exception) {
            $this->rollback();
        }
    }

    public function rollback()
    {
        if ($this->entityManager->getConnection()->isTransactionActive()) {
            $this->entityManager->rollBack();
        }
    }

    /**
     * @return ResourcesInterface
     */
    public function getPageCreate(): ResourcesInterface
    {
        return $this->pageCreate;
    }

    protected function createEmptyPhoto(string $group): Files
    {
        $photo = new Files();
        $photo->setGroup($group);
        $photo->setData($group, 'alt');
        $this->entityManager->persist($photo);
        $this->entityManager->flush();
        return $photo;
    }
}
