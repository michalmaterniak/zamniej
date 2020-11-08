<?php
namespace App\Application\Pages\Shop\Tags\Factory;

use App\Application\Locale\Locale;
use App\Application\Pages\Shop\Tags\Exception\TagsException;
use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Repository\Repositories\Shops\Tags\ShopTagsRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\ORM\EntityManagerInterface;

class TagsFactoryRequest extends TagsFactory
{
    /**
     * @var RequestPostContentData $requestPostContentData
     */
    protected $requestPostContentData;

    public function __construct(EntityManagerInterface $entityManager, ShopTagsRepository $shopTagsRepository, Locale $locale)
    {
        parent::__construct($entityManager, $shopTagsRepository, $locale);
    }

    public function factoryTagRequest() : ShopTags
    {
        if (!$this->requestPostContentData->checkIfExist('tag')) {
            throw TagsException::tagisNotDefinedInRequest();
        }

        return $this->factoryTag($this->requestPostContentData->getValue('tag', $this->requestPostContentData->getValue('locale', null)));
    }
}
