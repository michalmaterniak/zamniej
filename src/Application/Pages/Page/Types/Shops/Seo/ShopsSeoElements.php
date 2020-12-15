<?php
namespace App\Application\Pages\Page\Types\Shops\Seo;

use App\Application\Pages\Page\Seo\PageSeoElements;
use App\Application\Pages\Page\Types\Shops\Seo\Elements\ShopsSeoCanonical;
use App\Application\Pages\Page\Types\Shops\Seo\Elements\ShopsSeoDescription;
use App\Application\Pages\Page\Types\Shops\Seo\Elements\ShopsSeoHeader;
use App\Application\Pages\Page\Types\Shops\Seo\Elements\ShopsSeoTitle;

class ShopsSeoElements extends PageSeoElements
{
    /**
     * ShopsSeoElements constructor.
     * @param ShopsSeoTitle $seoTitle
     * @param ShopsSeoHeader $seoHeader
     * @param ShopsSeoDescription $seoDescription
     * @param ShopsSeoCanonical $seoCanonical
     */
    public function __construct(
        ShopsSeoTitle $seoTitle,
        ShopsSeoHeader $seoHeader,
        ShopsSeoDescription $seoDescription,
        ShopsSeoCanonical $seoCanonical
    )
    {

        parent::__construct($seoTitle, $seoHeader, $seoDescription, $seoCanonical);
    }

    /**
     * @param string|null $key
     * @return array|string[]
     */
    public function getAvailableProperties(): array
    {
        return [
            'name' => 'subpage.subpage.name',
            'parent.name' => 'parent.subpage.subpage.name',
            'parent.parent.name' => 'parent.parent.subpage.subpage.name',
            'parent.parent.parent.name' => 'parent.parent.subpage.subpage.name',
            'idSubpage' => 'subpage.subpage.idSubpage',
            'idResource' => 'resource.idResource',
        ];
    }

    /**
     * @return string[]|array
     */
    public function getAvailableMethods(): array
    {
        return [
            'letter'
        ];
    }
}
