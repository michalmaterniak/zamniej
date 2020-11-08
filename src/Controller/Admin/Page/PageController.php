<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 23.04.18
 * Time: 23:01
 */
namespace App\Controller\Admin\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PageController
 * @package App\Controller\Admin\Page
 */
class PageController extends AbstractController
{
    /**
     * @return Response
     * @Route("/admin/", name="admin-page-homepage", methods={"GET"})
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig');
    }
}
