<?php
namespace App\Application\SiteWide;

use App\Application\Pages\Page\Page;
use App\Application\SiteWide\Articles\ArticlesSiteWide;
use App\Application\SiteWide\Links\MainLinks;
use App\Entity\Entities\Pages\Pages;
use App\Repository\Repositories\Pages\PagesRepository;
use Doctrine\Common\Collections\ArrayCollection;

class InitFront
{
    /**
     * @var array $init
     */
    protected $init = [];


    /**
     * InitFront constructor.
     * @param MainLinks $mainLinks
     * @param ArticlesSiteWide $articlesBlog
     * @param RedirectLinks $redirectLinks
     */
    public function __construct(
        MainLinks $mainLinks,
        ArticlesSiteWide $articlesBlog,
        RedirectLinks $redirectLinks
    ) {
        $this->init[$mainLinks->getName()] = $mainLinks->getValue();
        $this->init[$articlesBlog->getName()] = $articlesBlog->getValue();
        $this->init[$redirectLinks->getName()] = $redirectLinks->getValue();
    }

    public function getInitFront()
    {
        return $this->init;
    }
}
