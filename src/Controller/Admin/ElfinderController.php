<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ElfinderController extends AbstractController
{
    public function load()
    {
        return $this->forward("FM\ElfinderBundle\Controller\ElFinderController::load");
    }

    public function show()
    {
        return $this->forward("FM\ElfinderBundle\Controller\ElFinderController::show");
    }

    public function mainJS()
    {
        return $this->render('elfinder/elfinder-main.js.twig');
    }
}
