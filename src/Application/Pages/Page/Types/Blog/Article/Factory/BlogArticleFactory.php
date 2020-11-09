<?php
namespace App\Application\Pages\Page\Types\Blog\Article\Factory;

use App\Application\Images\ImageManager;
use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\Types\Blog\Article\BlogArticleConfig;
use App\Entity\Entities\System\Files;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BlogArticleFactory
 * @package App\Application\Pages\Page\Types\Blog\Article\Factory
 */
class BlogArticleFactory extends PageFactory
{
    /**
     * @var ImageManager $imageManager
     */
    protected $imageManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        BlogArticleSubpageFactory $subpageFactory,
        BlogArticleConfig $resourceConfig,
        ImageManager $imageManager,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
        $this->imageManager = $imageManager;
    }
    public function afterCreateSubpage(): void
    {
        if (!empty($this->data['header'])) {
            $this->createHeaderPhoto($this->data['header']);
        } else {
            $photo = $this->createEmptyPhoto('header');
            $this->currentSubpage->addFile($photo);
            $this->entityManager->flush();

        }
    }
    protected function createHeaderPhoto(string $pathLogo)
    {
        $headerImg = new Files();
        $headerImg->setData('Nagłówek zdjęcie ' . $this->currentSubpage->getName(), 'alt');
        $headerImg->setGroup('header');
        $pathHeader = $this->imageManager->saveAsSubpage($this->currentSubpage, $pathLogo, 'header');
        $headerImg->setPath($pathHeader);
        $this->entityManager->persist($headerImg);
        $this->currentSubpage->addFile($headerImg);
        $this->entityManager->flush();
    }
}
