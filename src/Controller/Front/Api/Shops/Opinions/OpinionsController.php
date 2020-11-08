<?php
namespace App\Controller\Front\Api\Shops\Opinions;

use App\Application\Pages\PagesManager;
use App\Application\Pages\Shop\Opinions\Factory\FactoryOpinionsRequest;
use App\Application\Pages\Shop\Rating\Factory\FactoryRatingRequest;
use App\Application\Pages\Shop\Shop;
use App\Controller\Front\Api\AbstractController;
use App\Entity\Entities\Shops\Shops;
use App\Entity\Entities\Subpages\Subpages;
use Symfony\Component\Routing\Annotation\Route;

class OpinionsController extends AbstractController
{
    /**
     * @param Subpages               $subpage
     * @param PagesManager           $modelPagesManager
     * @param FactoryOpinionsRequest $factoryOpinionsRequest
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/page/api/shops/opinions/comment/{subpage}", name="page-api-shops-opinions-comment", methods={"POST"})
     */
    public function comment(
        Subpages $subpage,
        PagesManager $modelPagesManager,
        FactoryOpinionsRequest $factoryOpinionsRequest
    )
    {
        try {
            $shopModel = $modelPagesManager->loadShop($subpage->getResource());
            $comment = $factoryOpinionsRequest->factory($shopModel);

            return $this->json([
                'message' => 'Dziękujemy za opinie!',
                'comment' => $this->normalizer->normalize($comment, null, ['groups' => ['resource']]),
                'rating' => $shopModel->getRating(),
            ], 200);
        } catch (\ErrorException $exception) {
            return $this->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    /**
     * @param Shops                $shop
     * @param Shop                 $shopModel
     * @param FactoryRatingRequest $factoryRatingRequest
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \ErrorException
     * @Route("/page/api/shops/opinions/rating/{shop}", name="page-api-shops-opinions-ratig", methods={"POST"})
     */
    public function rating(Shops $shop, Shop $shopModel, FactoryRatingRequest $factoryRatingRequest)
    {
        try {
            $shopModel->loadEntity($shop);
            $factoryRatingRequest->addRatingRequest($shopModel);

            return $this->json([
                'message' => 'Dziękujemy za ocene!',
                'rating' => $shopModel->getRating(),

            ], 200);
        } catch (\ErrorException $exception) {
            return $this->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}
