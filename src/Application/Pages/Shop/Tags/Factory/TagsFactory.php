<?php
namespace App\Application\Pages\Shop\Tags\Factory;

use App\Application\Locale\Locale;
use App\Application\Pages\Shop\Tags\Exception\TagsException;
use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Repository\Repositories\Shops\Tags\ShopTagsRepository;
use Doctrine\ORM\EntityManagerInterface;

class TagsFactory
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var ShopTagsRepository $shopTagsRepository
     */
    protected $shopTagsRepository;

    /**
     * @var Locale $locale
     */
    protected $locale;

    public function __construct(
        EntityManagerInterface $entityManager,
        ShopTagsRepository $shopTagsRepository,
        Locale $locale
    )
    {
        $this->entityManager = $entityManager;
        $this->shopTagsRepository = $shopTagsRepository;
        $this->locale = $locale;
    }

    public function factoryTag(string $tagName, ?string $locale = null) : ShopTags
    {
        $locale = $locale ?: $this->locale->getLocale();

        if( $this->shopTagsRepository->counting(false)->findOneByNameTag($tagName, $locale)->getCount() > 0 )
        {
            throw TagsException::tagExist();
        }

        $shopTag = new ShopTags();
        $shopTag->addTag($tagName, $locale);
        $this->entityManager->persist($shopTag);
        $this->entityManager->flush();

    }
}
