<?php
namespace App\Application\Pages\Page\Types\Blog\Articles\Seo;

use App\Application\Pages\Page\Seo\Elements\PageSeoCanonical;
use App\Application\Pages\Page\Seo\Elements\PageSeoDescription;
use App\Application\Pages\Page\Seo\Elements\PageSeoHeader;
use App\Application\Pages\Page\Seo\Elements\PageSeoTitle;
use App\Application\Pages\Page\Seo\PageSeoElements;

class BlogArticlesSeoElements extends PageSeoElements
{
    /**
     * BlogArticlesSeoElements constructor.
     * @param PageSeoTitle $seoTitle
     * @param PageSeoHeader $seoHeader
     * @param PageSeoDescription $seoDescription
     * @param PageSeoCanonical $seoCanonical
     */
    public function __construct(
        PageSeoTitle $seoTitle,
        PageSeoHeader $seoHeader,
        PageSeoDescription $seoDescription,
        PageSeoCanonical $seoCanonical
    )
    {
        parent::__construct($seoTitle, $seoHeader, $seoDescription, $seoCanonical);
    }
}
