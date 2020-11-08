<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Offers\Factory\Offers\OfferProductFactory;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersHotPricesRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @var WebepartnersHotPricesRepository $webepartnersHotPricesRepository
     */
    protected $webepartnersHotPricesRepository;

    /**
     * @param WebepartnersHotPricesRepository $webepartnersHotPricesRepository
     * @required
     */
    public function setWebepartnersHotPricesRepository(WebepartnersHotPricesRepository $webepartnersHotPricesRepository): void
    {
        $this->webepartnersHotPricesRepository = $webepartnersHotPricesRepository;
    }
    /**
     * @param WebepartnersPrograms $idShop
     * @Route("/admin/api/affiliations/webepartners/products/{idShop}", name="admin-api-affiliations-webepartners-products", requirements={"idShop"="\d+"}, methods={"POST"})
     */
    public function getProduct(WebepartnersPrograms $idShop)
    {
        $result = $this->webepartnersHotPricesRepository->findAllActiveByShopByPercentRabat($idShop);
        $count = $result->count();
        $products = new ArrayCollection();
        foreach ($result as $product) {
            $products->add($product['product']);
        }

        return $this->json([
            'count' => $count,
            'products' => $this->normalizer->normalize($products, null, ['groups' => ['resource-admin-listing', 'offers-admin-listing', 'resource-admin-listing-shops']]),
        ], 200);
    }
    /**
     * @param RequestPostContentData $requestPostContentData
     * @Route("/admin/api/affiliations/webepartners/products/createOffer", name="admin-api-affiliations-webepartners-products-createOffer", methods={"POST"})
     */
    public function createOffer(RequestPostContentData $requestPostContentData, OfferProductFactory $offerProductFactory)
    {
        $products = $this->webepartnersHotPricesRepository->select()->findAllByIdsOfferIsNull($requestPostContentData->getValue('products', []))->getResults();

        $count = 0;
        $offersProduct = [];
        foreach ($products as $product) {
            $count++;
            $offersProduct[$product->getIdOffer()] = $offerProductFactory->create($product);
        }

        return $this->json([
            'message' => 'Utworzono '.$count.' ofert',
            'products' => $this->normalizer->normalize($offersProduct, null, [
                'groups' => ['resource-admin'],
            ]),
        ]);
    }
}
