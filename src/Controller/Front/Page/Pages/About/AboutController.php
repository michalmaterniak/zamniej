<?php
namespace App\Controller\Front\Page\Pages\About;

use App\Application\Pages\Page\Page;
use App\Controller\Front\Page\AbstractController;

class AboutController extends AbstractController
{
    public function index(Page $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/about/about.html.twig');
    }
}
