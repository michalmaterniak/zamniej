<?php

namespace App\Controller\Admin\Api\Affiliations\Tradetracker;

use App\Controller\Admin\Api\AbstractController;
use App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerProgramsRepository;
use App\Twig\TemplateVars;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProgramsController extends AbstractController
{
    /**
     * @var TradetrackerProgramsRepository $tradetrackerProgramsRepository
     */
    protected $tradetrackerProgramsRepository;

    public function __construct(TradetrackerProgramsRepository $tradetrackerProgramsRepository, NormalizerInterface $normalizer, TemplateVars $templateVars)
    {
        parent::__construct($normalizer, $templateVars);
        $this->tradetrackerProgramsRepository = $tradetrackerProgramsRepository;
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-new", name="admin-api-affiliations-tradetracker-programs-new", methods={"POST"})
     */
    public function new()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getNewPrograms()->getResults();
        
        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => ['program-admin-list']]),
        ], 200);
    }


    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-active", name="admin-api-affiliations-tradetracker-programs-active", methods={"POST"})
     */
    public function active()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getActivePrograms()->withSubpageAndResource()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-unactive", name="admin-api-affiliations-tradetracker-programs-unactive", methods={"POST"})
     */
    public function unactive()
    {
        $programs = $this->tradetrackerProgramsRepository->select()->getUnactivePrograms()->getResults();

        return $this->json([
            'programs' => $this->normalizer->normalize($programs, null, ['groups' => 'program-admin-list']),
        ], 200);
    }

    /**
     * @Route("/admin/api/affiliations/tradetracker/programs-program/{id}", name="admin-api-affiliations-tradetracker-programs-program", methods={"POST"})
     */
    public function program($id)
    {
        $program = $this->tradetrackerProgramsRepository->select()->getProgramById($id)->withSubpageAndResource()->getResultOrNull();
        return $this->json([
            'program' => $this->normalizer->normalize($program, null, ['groups' => 'program-admin']),
        ], 200);
    }
}
