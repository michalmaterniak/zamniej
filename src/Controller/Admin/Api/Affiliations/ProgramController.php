<?php
namespace App\Controller\Admin\Api\Affiliations;
use App\Application\Pages\Shop\Affiliations\TieProgramWithSubpage;
use App\Application\Pages\Shop\Factory\ShopFactoryAffiliation;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Resources;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    /**
     * @param RequestPostContentData $contentData
     * @param ShopRepository $shopRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @Route("/admin/api/affiliations/program/searchSubpages", name="admin-api-affiliations-program-searchSubpages", methods={"POST"})
     */
    public function searchSubpages(RequestPostContentData  $contentData, ShopRepository $shopRepository)
    {
        if(!$contentData->checkIfExist('name'))
            return $this->json([
                'message' => "Nazwa programu musi zostać przesłana"
            ], 500);

        $subpages = $shopRepository->select()->searchSubpagesByName($contentData->getValue('name'))->getResults();
        return $this->json([
            'subpages' => $this->normalizer->normalize($subpages, null, ['groups' => 'search-to-tie-programs'])
        ], 200);
    }

    /**
     * @param ShopsAffiliation $idShop
     * @param RequestPostContentData $contentData
     * @param TieProgramWithSubpage $tieProgramWithSubpage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @Route("/admin/api/affiliations/program/tie/{idShop}", name="admin-api-affiliations-program-tie", methods={"POST"})
     */
    public function tie(ShopsAffiliation  $idShop, RequestPostContentData  $contentData, TieProgramWithSubpage  $tieProgramWithSubpage)
    {
        if(!$contentData->checkIfExist('idSubpage'))
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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
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
        }
        catch (\ErrorException $exception)
        {
            return $this->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
