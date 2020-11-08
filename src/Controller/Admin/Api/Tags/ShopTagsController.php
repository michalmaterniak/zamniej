<?php
namespace App\Controller\Admin\Api\Tags;

use App\Application\Pages\Shop\Tags\Factory\TagsFactoryRequest;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Entity\Entities\Shops\Tags\ShopTagsTranslate;
use App\Repository\Repositories\Shops\Tags\ShopTagsRepository;
use App\Repository\Repositories\Shops\Tags\ShopTagsTranslateRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\Routing\Annotation\Route;

class ShopTagsController extends AbstractController
{
    /**
     * @param ShopTagsRepository $shopTagsRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @Route("/admin/api/tags/tags", name="admin-api-tags-tags", methods={"POST"})
     */
    public function tags(ShopTagsRepository $shopTagsRepository)
    {
        $tags = $shopTagsRepository->select()->findAllWithTags()->getResults();

        return $this->json([
            'tags' => $this->normalizer->normalize($tags, null, ['groups' => ['resource-admin']]),
        ], 200);
    }

    /**
     * @param RequestPostContentData      $requestPostContentData
     * @param ShopTagsRepository          $shopTagsRepository
     * @param ShopTagsTranslateRepository $shopTagsTranslateRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/admin/api/tags/store/{shopTag}", name="admin-api-tags-store", methods={"POST"}, requirements={"shopTag": "\d+"})
     */
    public function store(ShopTags $shopTag, RequestPostContentData $requestPostContentData, ShopTagsRepository $shopTagsRepository, ShopTagsTranslateRepository $shopTagsTranslateRepository)
    {
        try {
            if (!$requestPostContentData->checkIfExist('tag') || !$requestPostContentData->checkIfExist('locale')) {
                throw new \ErrorException('\'tag\' oraz/lub \'locale\' nie zostały zdefiniowane');
            }

            $tag = $requestPostContentData->getValue('tag');
            $locale = $requestPostContentData->getValue('locale');


            if ($tagTranslate = $shopTag->getTag($locale)) {
                if ($tag) {
                    $tagTranslate->setName($tag);
                } else {
                    $shopTag->getTags()->remove($locale);
                    $this->getDoctrine()->getManager()->remove($tagTranslate);
                    if ($shopTag->getTags()->count() === 0) {
                        $this->getDoctrine()->getManager()->remove($shopTag);
                    }
                }
            } else {
                $tagTranslate = $shopTag->addTag($tag, $locale);
                $this->getDoctrine()->getManager()->persist($tagTranslate);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->json([
                'success' => true,
                'message' => "Edytowano tag",
            ]);
        } catch (\ErrorException $exception) {
            return $this->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * @param TagsFactoryRequest $tagsFactoryRequest
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @Route("/admin/api/tags/new", name="admin-api-tags-new", methods={"POST"})
     */
    public function new(TagsFactoryRequest $tagsFactoryRequest)
    {
        try {
            $shopTag = $tagsFactoryRequest->factoryTagRequest();

            return $this->json([
                'success' => true,
                'message' => "Dodano tag",
                'tag'     => $this->normalizer->normalize($shopTag, null, ['groups' => ['resource-admin']]),
            ]);
        } catch (\ErrorException $exception) {
            return $this->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}
