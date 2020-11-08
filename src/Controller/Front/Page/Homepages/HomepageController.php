<?php
namespace App\Controller\Front\Page\Homepages;

use App\Application\Pages\Homepage\Homepage;
use App\Controller\Front\Page\AbstractController;

class HomepageController extends AbstractController
{
    public function index(Homepage $page)
    {
        $this->twigArray->insert('page', $page);

        return $this->renderTwig('page/homepage/homepage.html.twig');
    }
}
