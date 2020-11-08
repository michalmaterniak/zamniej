<?php
namespace App\Controller\Front\Api;

use App\Twig\Interfaces\TemplateInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as GlobalController;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AbstractController extends GlobalController
{
    /**
     * @var TemplateInterface $templateVars
     */
    protected $templateVars;

    /**
     * @var NormalizerInterface $normalizer
     */
    protected $normalizer;
    public function __construct(TemplateInterface $templateVars, NormalizerInterface $normalizer)
    {
        $this->templateVars = $templateVars;
        $this->normalizer = $normalizer;
    }

    public function responseJson(int $status = 200)
    {
        return $this->json($this->templateVars->getVars(), $status);
    }
}
