<?php
namespace App\Services\Admin\Form\Updater;

use App\Entity\Entities\Subpages\Resources;
use App\Services\Admin\Form\Updater\Fields\Interfaces\FiledResourceUpdater;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;

class ResourceUpdater
{
    /**
     * @var array $properties
     */
    protected $properties = [];

    /**
     * @var FormComponentsUpdate $formComponentsUpdate
     */
    protected $formComponentsUpdate;

    /**
     * @var FiledResourceUpdater $updater
     */
    protected $updater;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;
    public function __construct(
        FormComponentsUpdate   $formComponentsUpdate,
        EntityManagerInterface $entityManager,
        RequestPostContentData $requestPostContentData
    ) {
        $this->entityManager = $entityManager;
        $this->formComponentsUpdate = $formComponentsUpdate;
        $this->properties = $requestPostContentData->getValue('modelEntity', []);

    }

    public function updateResource(Resources $resource)
    {
        $this->updater = $this->formComponentsUpdate->getUpdater('simple');
        $this->updater->save2($resource, $this->properties);
//        foreach ($this->properties as $property) {
//            $this->updater = $this->formComponentsUpdate->getUpdater('simple');
//            $this->updater->save2($resource, $this->properties);
//        }
    }

    public function flush()
    {
        $this->entityManager->flush();
    }
}
