<?php
namespace App\Controller\Admin\Api\Affiliations;
use App\Application\Pages\Shop\Affiliations\TieProgramWithSubpage;
use App\Application\Pages\Shop\Factory\ShopFactoryAffiliation;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Resources;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Doctrine\Common\Collections\ArrayCollection;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ProgramController extends AbstractController
{
    /**
     * @param RequestPostContentData $contentData
     * @param ShopRepository $shopRepository
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/affiliations/program/searchSubpages", name="admin-api-affiliations-program-searchSubpages", methods={"POST"})
     */
    public function searchSubpages(RequestPostContentData  $contentData, ShopRepository $shopRepository)
    {
        if (!$contentData->checkIfExist('name'))
            return $this->json([
                'message' => "Nazwa programu musi zostać przesłana"
            ], 500);

        $subpages = new ArrayCollection();

        foreach ($shopRepository->select()->searchSubpagesByName($contentData->getValue('name'))->getResults() as $resource) {
            foreach ($resource->getSubpages() as $subpage) {
                $subpages->add($subpage);
            }
        }

        return $this->json([
            'subpages' => $this->normalizer->normalize($subpages, null, ['groups' => 'search-to-tie-programs'])
        ], 200);
    }

    /**
     * @param ShopsAffiliation $idShop
     * @param RequestPostContentData $contentData
     * @param TieProgramWithSubpage $tieProgramWithSubpage
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/affiliations/program/merge/{idShop}", name="admin-api-affiliations-program-merge", methods={"POST"})
     */
    public function merge(ShopsAffiliation $idShop, RequestPostContentData $contentData, TieProgramWithSubpage $tieProgramWithSubpage)
    {
        if (!$contentData->checkIfExist('idSubpage'))
            return $this->json([
                'message' => "Id podstrony musi zostać zdefiniowane"
            ], 500);

        $tieProgramWithSubpage->setShopAffiliation($idShop);
        $tieProgramWithSubpage->setShopsSubpage($contentData->getValue('idSubpage'));
        $tieProgramWithSubpage->tie();
        return $this->json([
            'program' => $this->normalizer->normalize($idShop, null, ['groups' => 'program-admin'])
        ], 200);
    }

    /**
     * @param ShopsAffiliation $idShop
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/affiliations/program/trash/{idShop}", name="admin-api-affiliations-program-trash", methods={"POST"})
     */
    public function trash(ShopsAffiliation $idShop)
    {
        $idShop->setSubpage(null);
        $idShop->setIsNew(false);
        $this->getDoctrine()->getManager()->flush();
        return $this->json([
            'program' => $this->normalizer->normalize($idShop, null, ['groups' => 'program-admin'])
        ], 200);
    }

    /**
     * @param Resources $idCategory
     * @param ShopsAffiliation $idShop
     * @param ShopFactoryAffiliation $shopFactoryAffiliation
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/affiliations/program/createShopSubpage/{idCategory}/{idShop}", name="admin-api-affiliations-program-createSubpage", methods={"POST"})
     */
    public function createSubpage(
        Resources $idCategory,
        ShopsAffiliation $idShop,
        ShopFactoryAffiliation $shopFactoryAffiliation
    )
    {
        try {
            $factory = $shopFactoryAffiliation->createByAffiliate($idShop, $idCategory);
            $factory->save();
            return $this->json([
                'program' => $this->normalizer->normalize($idShop, null, ['groups' => 'program-admin'])
            ]);
        } catch (ErrorException $exception) {
            return $this->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
