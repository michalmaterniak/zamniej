<?php
namespace App\Controller\Admin\Api\Pages\Resource;

use App\Application\Pages\PagesManager;
use App\Controller\Admin\Api\AbstractController;
use App\Twig\TemplateVars;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractResourceController extends AbstractController
{
    /**
     * @var PagesManager $pagesManager
     */
    protected $pagesManager;

    /**
     * AbstractResourceController constructor.
     * @param NormalizerInterface $normalizer
     * @param PagesManager $modelPagesManager
     * @param TemplateVars $templateVars
     */
    public function __construct(
        NormalizerInterface $normalizer,
        PagesManager $modelPagesManager,
        TemplateVars $templateVars
    ) {
        parent::__construct($normalizer, $templateVars);
        $this->pagesManager = $modelPagesManager;
    }

    protected function returnClassNameController(string $className)
    {
        return  'App\\Controller\\Admin\\Api\\Pages\\'.$className.'Controller';
    }
    protected function canForward(string $controller, string $method) : bool
    {
        $className = $this->returnClassNameController($controller);

        return class_exists($className) && method_exists($className, $method);
    }
}
