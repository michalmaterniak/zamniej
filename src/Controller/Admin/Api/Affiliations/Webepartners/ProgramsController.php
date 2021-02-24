<?php
namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Application\Affiliations\Webepartners\Api\Programs\ProgramWebepartners;
use App\Application\Affiliations\Webepartners\Programs\ProgramsWebepartnersFactory;
use App\Application\Affiliations\Webepartners\Urls\UrlToTrackingConverterWebepartners;
use App\Application\QueueManager\Producers\Webepartners\OffersProducer;
use App\Controller\Admin\Api\AbstractController;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\System\Request\Retrievers\RequestData\RequestPostContentData;
use App\Twig\TemplateVars;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProgramsController extends AbstractController
{
    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    public function __construct(WebepartnersProgramsRepository $webepartnersProgramsRepository, NormalizerInterface $normalizer, TemplateVars $templateVars)
    {
        parent::__construct($normalizer, $templateVars);
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
    }

    /**
     * @Route("/admin/api/affiliations/webepartners/programs-convertUrl", name="admin-api-affiliations-webepartners-programs-convertUrl", methods={"POST"})
     */
    public function convertUrl(UrlToTrackingConverterWebepartners $trackingUrlWebepartners, RequestPostContentData $requestPostContentData)
    {
        if ($url = $trackingUrlWebepartners->getUrl($requestPostContentData->getValue('url', false))) {
            return $this->responseJson(
                [
                    'success' => true,
                    'tracking-url-webeparnets' => $url
                ]);
        } else {
            return $this->json([
                'success' => false,
                'message' => 'nie znaleziono adresu'
            ]);
        }

    }

    /**
     * @Route("/admin/api/affiliations/webepartners/programs-new", name="admin-api-affiliations-programs-new", methods={"POST"})
     */
    public function new()
    {
        $programs = $this->webepartnersProgramsRepository->select()->getNewPrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => ['program-admin-list']]),
        ], 200);
    }


    /**
     * @Route("/admin/api/affiliations/webepartners/programs-active", name="admin-api-affiliations-programs-active", methods={"POST"})
     */
    public function active()
    {
        $programs = $this->webepartnersProgramsRepository->select()->getActivePrograms()->withSubpageAndResource()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }


    /**
     * @Route("/admin/api/affiliations/webepartners/programs-unactive", name="admin-api-affiliations-programs-unactive", methods={"POST"})
     */
    public function unactive()
    {
        $programs = $this->webepartnersProgramsRepository->select()->getUnactivePrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/webepartners/programs-program/{id}", name="admin-api-affiliations-programs-program", methods={"POST"})
     */
    public function program(int $id)
    {
        $program = $this->webepartnersProgramsRepository->select()->getProgramById($id)->withSubpageAndResource()->getResultOrNull();

        return $this->json([
            'program' => $this->normalizer->normalize($program, null, ['groups' => 'program-admin']),
        ], 200);
    }

    /**
     * @param WebepartnersPrograms $shop
     * @param ProgramWebepartners $apiProgramWebepartners
     * @param ProgramsWebepartnersFactory $programsWebepartnersFactory
     * @param OffersProducer $offersProducer
     * @return JsonResponse
     * @throws ExceptionInterface
     * @throws NonUniqueResultException
     * @Route("/admin/api/affiliations/webepartners/programs-update/{shop}", name="admin-api-affiliations-program-update", methods={"POST"})
     */
    public function update(
        WebepartnersPrograms $shop,
        ProgramWebepartners $apiProgramWebepartners,
        ProgramsWebepartnersFactory $programsWebepartnersFactory,
        OffersProducer $offersProducer
    )
    {
        $webeData = $apiProgramWebepartners->getProgram($shop->getExternalId());

        $programsWebepartnersFactory->updateProgram($webeData, $shop);

        $offersProducer->addToQueue($shop);

        return $this->json([
            'program' => $this->normalizer->normalize($shop, null, ['groups' => 'program-admin']),
            'message' => "Zaktualizowano program oraz dodano do kolejki pobranie nowych ofert"
        ], 200);
    }
}
