<?php


namespace App\Controller\Front\Api;

class ErrorsController extends AbstractController
{
    public function error404()
    {
        $this->templateVars->insert('message', 'Podana strona nie istnieje');

        return $this->responseJson(404);
    }
}
