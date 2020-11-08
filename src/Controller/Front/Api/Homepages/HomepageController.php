<?php
namespace App\Controller\Front\Api\Homepages;

use App\Application\Pages\Homepage\Homepage;
use App\Controller\Front\Api\AbstractController;

class HomepageController extends AbstractController
{
    public function index(Homepage $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
