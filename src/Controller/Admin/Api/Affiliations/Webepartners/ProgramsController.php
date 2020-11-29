<?php

namespace App\Controller\Admin\Api\Affiliations\Webepartners;

use App\Controller\Admin\Api\AbstractController;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Twig\TemplateVars;
use Symfony\Component\Routing\Annotation\Route;
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
        $programs = $this->webepartnersProgramsRepository->select()->getActivePrograms()->getResults();

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
        $program = $this->webepartnersProgramsRepository->select()->getProgramById($id)->getResultOrNull();

        return $this->json([
            'program' => $this->normalizer->normalize($program, null, ['groups' => 'program-admin']),
        ], 200);
    }
}
