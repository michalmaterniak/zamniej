<?php
namespace App\Controller\Front\Api\Pages\About;

use App\Application\Pages\Page\Page;
use App\Controller\Front\Api\AbstractController;

class AboutController extends AbstractController
{
    public function index(Page $page)
    {
        $this->templateVars->insert('model', $this->normalizer->normalize($page, null, [
            'groups' => ['resource', 'seo', 'subpage'],
        ]));

        return $this->responseJson();
    }
}
