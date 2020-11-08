<?php
namespace App\Services\Pages\Resource;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Interfaces\ResourcesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Resource
 * @package App\Services\Pages\Resource
 */
abstract class Resource
{
    /**
     * @var ResourcesInterface $modelResource
     */
    private $modelResource;

    /**
     * @var Resources $modelEntity
     */
    private $modelEntity;

    /**
     * @var ResourceSubpagesManager $resourceSubpagesManager
     */
    private $resourceSubpagesManager;

    /**
     * @var ResourceComponents $resourceComponents
     */
    private $resourceComponents;

    /**
     * @var Resource[]|ArrayCollection
     */
    private $children;

    public function __construct(
        ResourceSubpagesManager $resourceSubpagesManager,
        ResourceComponents $resourceComponents
    ) {
        $this->resourceComponents = $resourceComponents;
        $this->resourceSubpagesManager = $resourceSubpagesManager;
    }

    protected function afterLoadEntity(Resources $entity) : void{}

    public function loadEntity(Resources $entity)
    {
        $this->modelEntity = $entity;
        $this->resourceSubpagesManager = clone $this->resourceSubpagesManager;
        $this->resourceSubpagesManager->loadResource($this);

        $this->afterLoadEntity($entity);
    }

    /**
     * @return Resources
     * @Groups({"resource-admin-list", "resource-admin", "resource"})
     */
    public function getModelEntity(): Resources
    {
        return $this->modelEntity;
    }

    /**
     * @return ResourcesInterface
     * @Groups({"resource-admin"})
     */
    public function getModelResource(): ResourcesInterface
    {
        if (!$this->modelResource)
            $this->setModelResource();

        return $this->modelResource;
    }

    /**
     * @param ResourcesInterface|null $modelResource
     */
    public function setModelResource(ResourcesInterface $modelResource = null): void
    {
        if ($modelResource === null)
            $modelResource = $this->getComponents()->getPageResourceRepository()->select()->byResource($this->modelEntity)->withRelations()->getResultOrNull();

        $this->modelResource = $modelResource;
    }

    public function getResourceRemove()
    {
        $remover = $this->getComponents()->getResourceRemove();
        $remover->loadResource($this);
        return $remover;
    }

    /**
     * @return ResourceSubpage[]|ArrayCollection
     * @Groups({"resource-admin-list", "resource-admin"})
     */
    public function getSubpages()
    {
        return $this->resourceSubpagesManager->getSubpages();
    }

    /**
     * @param string|null $locale
     * @return ResourceSubpage
     * @Groups({"resource"})
     */
    public function getSubpage(string $locale = null)
    {
        return $this->resourceSubpagesManager->getSubpage($locale);
    }

    /**
     * @return ResourceComponents
     */
    public function getComponents(): ResourceComponents
    {
        return $this->resourceComponents;
    }

    /**
     * @return ArrayCollection|Resource[]
     */
    public function getParents() : ArrayCollection
    {
        return $this->getComponents()->getResourcesManager()->loadEntities($this->getModelEntity()->getParents());
    }

    /**
     * @return ArrayCollection|Resource[]
     * @Groups({"resource"})
     */
    public function getBreadcrumbs() : ArrayCollection
    {
        $breadcrumbs = [];
        foreach ($this->getParents() as $parent)
        {
            $breadcrumbs[] = [
                'name' => $parent->getSubpage()->getSubpage()->getName(),
                'slug' => $parent->getSubpage()->getSlug()
            ];
        }
        $breadcrumbs[] = [
            'name' =>   $this->getSubpage()->getSubpage()->getName(),
            'slug' => $this->getSubpage()->getSlug()
        ];
        return new ArrayCollection($breadcrumbs);
    }

    public function getChildren()
    {
        if(!$this->children)
        {
            $this->children = $this->getComponents()->getResourcesManager()->loadEntities(
                $this->getComponents()->getResourceRepository()->select()->getChildren($this->getModelEntity())->getResults()
            );
        }
        return $this->children;
    }

    /**
     * @return string
     * @Groups({"resource"})
     */
    public function getResourceType()
    {
        return $this->getComponents()->getResourceConfig()->getTypeName();
    }
}
