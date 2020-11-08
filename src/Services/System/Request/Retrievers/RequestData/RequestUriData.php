<?php
namespace App\Services\System\Request\Retrievers\RequestData;

use App\Services\System\Request\Retrievers\RequestData;

class RequestUriData extends RequestData
{
    protected function setData()
    {
        $this->vars = $this->requestStack->getCurrentRequest() ? $this->requestStack->getCurrentRequest()->attributes->all() : [];
    }
}
