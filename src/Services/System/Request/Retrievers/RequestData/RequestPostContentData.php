<?php
namespace App\Services\System\Request\Retrievers\RequestData;

use App\Services\System\Request\Retrievers\RequestData;

class RequestPostContentData extends RequestData
{
    protected function setData()
    {
        $contentPost =  $this->requestStack->getCurrentRequest() ? $this->requestStack->getCurrentRequest()->getContent() : '[]';
        $this->vars =   json_decode($contentPost, true) ?: [];
    }
}
