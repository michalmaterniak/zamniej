<?php
namespace App\Application\Pages\Page;

use App\Services\Pages\Resource\ResourceSubpage;

abstract class PageSubpage extends ResourceSubpage
{
    public function __construct(PageComponents $components)
    {
        parent::__construct($components);
    }
}
