<?php
namespace App\Controller\Front\Page;

use App\Application\Locale\FinderSubpageBySlug;
use App\Application\Pages\Homepage\Services\UpdatePromotionsHomepage;
use App\Application\Pages\PagesManager;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Repositories\Shops\Offers\OffersRepository;
use App\Twig\TemplateVars;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as GlobalController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends GlobalController
{
    /**
     * @var TemplateVars $templateVars
     */
    protected $templateVars;

    public function __construct(TemplateVars $templateVars)
    {
        $this->templateVars = $templateVars;
    }

    /**
     * @param PagesManager $modelPagesManager
     * @param KernelInterface $httpKernel
     * @return Response
     * @Route("/{slug?}", name="page-pages-main", requirements={"slug"="^((?!elfinder|efconnect).)*$"}, methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function main(
        PagesManager $modelPagesManager,
        KernelInterface $httpKernel
    )
    {
        if ($httpKernel->getEnvironment() == 'prod') {
            return new Response('', 404);
        }
        $page = $modelPagesManager->getCurrentResourceModel(true);

        if (!$page) {
            throw new NotFoundHttpException();
        }

        $this->templateVars->insert('page', $page);
        $className = 'App\\Controller\\Front\\Page\\' . $page->getComponents()->getResourceConfig()->getController() . 'Controller';

        return $this->forward($className . '::index', [
            'page' => $page,
        ]);
    }

    /**
     * @param int|null $idOffer
     * @param OffersRepository $offersRepository
     * @return RedirectResponse|Response
     * @Route("/go-to-offer/{idOffer?}", priority=10, name="page-pages-redirect-offer", requirements={"idOffer"="\d*"}, methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function goToOffer(?int $idOffer, OffersRepository $offersRepository)
    {
        if(is_numeric($idOffer) && $idOffer > 0) {
            $offer = $offersRepository->select()->getOneOfferByIdWithSubpage($idOffer)->getResultOrNull();
            if($offer) {
                $offer->addRedirect();
                $this->getDoctrine()->getManager()->flush();

                return $this->redirect($offer->getUrl());
            }
        }

        return new Response('', 404);

    }

    /**
     * @param int|null $idShop
     * @param ShopsAffiliationRepository $shopsAffiliationRepository
     * @return RedirectResponse|Response
     * @Route("/go-to-shop/{idShop?}", priority=10, name="page-pages-redirect-shop", requirements={"idShop"="\d*"}, methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function goToShop(?int $idShop, ShopsAffiliationRepository $shopsAffiliationRepository)
    {
        if(is_numeric($idShop) && $idShop > 0) {
            $shop = $shopsAffiliationRepository->find($idShop);
            if($shop) {
                $shop->addRedirect();
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($shop->getTrackingUrl());
            }
        }

        return new Response('', 404);
    }
}
