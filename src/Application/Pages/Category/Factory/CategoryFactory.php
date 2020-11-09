<?php
namespace App\Application\Pages\Category\Factory;

use App\Application\Images\ImageManager;
use App\Application\Pages\Category\CategoryConfig;
use App\Entity\Entities\System\Files;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryFactory
 * @package App\Application\Pages\Category\Factory
 */
class CategoryFactory extends ResourceFactory
{
    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        CategorySubpageFactory $subpageFactory,
        CategoryConfig $resourceConfig,
        ImageManager $imageManager,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
        $this->imageManager = $imageManager;
    }

    public function afterCreateResource(): void
    {
        if (!empty($this->data['header'])) {
            $this->createLogo($this->data['logo']);
        } else {
            $photo = $this->createEmptyPhoto('logo');
            $this->resourceCreate->addFile($photo);
            $this->entityManager->flush();
        }
    }

    protected function createLogo(string $path)
    {
        $logoMini = new Files();
        $logoMini->setData('Logo ' . $this->resourceCreate->getName(), 'alt');
        $logoMini->setGroup('logo');
        $path = $this->imageManager->saveAsResource($this->resourceCreate, $path, 'logo');
        $logoMini->setPath($path);
        $this->resourceCreate->addFile($logoMini);
        $this->entityManager->persist($logoMini);
    }
}
