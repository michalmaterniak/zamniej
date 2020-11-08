<?php
namespace App\Controller\Admin\Api\Pages;

use App\Application\Pages\PagesManager;
use App\Controller\Admin\Api\AbstractController;
use App\Repository\Repositories\Subpages\ResourcesRepository;
use App\Twig\TemplateVars;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractResourceController extends AbstractController
{
    /**
     * @var PagesManager $modelPagesManager
     */
    protected $modelPagesManager;

    /**
     * @var ResourcesRepository $resourcesRepository
     */
    protected $resourcesRepository;


    public function __construct(
        NormalizerInterface         $normalizer,
        PagesManager                $modelPagesManager,
        ResourcesRepository         $resourcesRepository,
        TemplateVars                $templateVars
    ) {
        parent::__construct($normalizer, $templateVars);
        $this->modelPagesManager =      $modelPagesManager;
        $this->resourcesRepository =    $resourcesRepository;
    }

    /**
     * @param $path
     * @param string|FormInterface $form
     * @param null                 $data
     * @param array                $options
     */
    public function buildForm($path, $form, $data = null, $options = [])
    {
        if ((is_string($form) && class_exists($form)) || $form instanceof FormInterface) {
            if (is_string($form)) {
                $form = $this->createForm($form, $data, $options);
            }
        } else {
            throw new \ErrorException('form is incorrect');
        }

        $formView = $this->renderView($path, [
            'form' => $form->createView(),
        ]);
        $this->templateVars->insert('form', $formView);
    }

}
