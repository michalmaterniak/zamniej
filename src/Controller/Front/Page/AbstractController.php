<?php
namespace App\Controller\Front\Page;

use App\Services\Pages\Resource\Resource;
use App\Twig\Interfaces\TemplateInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as GlobalController;
use Symfony\Component\HttpFoundation\Response;

class AbstractController extends GlobalController
{
    /**
     * @var Resource $resource
     */
    protected $page;

    /**
     * @var TemplateInterface
     */
    protected $twigArray;

    public function __construct(TemplateInterface $templateVars)
    {
        $this->twigArray = $templateVars;
    }

    protected function renderTwig(string $view, Response $response = null): Response
    {
        return parent::render($view, $this->twigArray->getVars()->toArray(), $response);
    }
}
