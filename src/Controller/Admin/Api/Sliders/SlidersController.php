<?php
namespace App\Controller\Admin\Api\Sliders;

use App\Application\Sliders\SlidersManager;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Sliders\Sliders;
use App\Entity\Entities\Sliders\Slides;
use App\Repository\Repositories\Sliders\SlidersRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class SlidersController extends AbstractController
{
    /**
     * @param SlidersRepository $slidersRepository
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/sliders/sliders/listing/", name="admin-api-sliders-sliders-listing", methods={"POST"})
     */
    public function listing(SlidersRepository $slidersRepository)
    {
        return $this->json([
            'sliders' => $this->normalizer->normalize($slidersRepository->select()->findAllActiveListing()->getResults(), null, [
                'groups' => [
                    'resource-admin-listing',
                ],
            ]),
        ]);
    }

    /**
     * @param int $slider
     * @param SlidersRepository $slidersRepository
     * @return JsonResponse
     * @throws ExceptionInterface
     * @Route("/admin/api/sliders/sliders/slider/{slider}", name="admin-api-sliders-sliders-slider", methods={"POST"})
     */
    public function slider(int $slider, SlidersRepository $slidersRepository)
    {
        return $this->json([
            'slider' => $this->normalizer->normalize($slidersRepository->select(false)->findAllSlidesBySlider($slider)->getResultOrNull(), null, [
                'groups' => [
                    'slider-admin',
                ],
            ]),
        ]);
    }

    /**
     * @Route("/admin/api/sliders/sliders/add-offer-to-slider/{offer}/{slider}", name="admin-api-sliders-sliders-addOfferToSlider", methods={"POST"})
     */
    public function addOfferToSlider(Offers $offer, Sliders $slider, SlidersManager $slidersManager)
    {
        $slidersManager->addSlideByOffer($offer, $slider);

        return $this->json([
            'success' => true,
        ]);
    }

    /**
     * @param Slides $slide
     * @return JsonResponse
     * @Route("/admin/api/sliders/sliders/removeSlide/{slide}", name="admin-api-sliders-sliders-removeSlide", methods={"POST"})
     */
    public function removeSLide(Slides $slide)
    {
        $this->getDoctrine()->getManager()->remove($slide);
        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'success' => true,
        ]);
    }
}
