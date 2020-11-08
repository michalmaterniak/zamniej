<?php
namespace App\Application;

use App\Application\Pages\PagesManager;
use App\Services\Components\Components as GlobalComponents;

class Components extends GlobalComponents
{
    /**
     * @var PagesManager $pageManager
     */
    protected $pageManager;
    public function __construct(
        PagesManager $pageManager
    )
    {
        $this->pageManager = $pageManager;
    }

    /**
     * @return PagesManager
     */
    public function getPageManager(): PagesManager
    {
        return $this->pageManager;
    }
}
