<?php
namespace App\Application\Pages\Shop\Seo;

use App\Application\Pages\Shop\Seo\Elements\ShopSeoCanonical;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoDescription;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoHeader;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoTitle;
use App\Services\Seo\SeoElements;

class ShopSeoElements extends SeoElements
{
    public function __construct(
        ShopSeoTitle        $seoTitle,
        ShopSeoHeader       $seoHeader,
        ShopSeoDescription  $seoDescription,
        ShopSeoCanonical    $seoCanonical
    ) {
        parent::__construct($seoTitle, $seoHeader, $seoDescription, $seoCanonical);
    }

    /**
     * @param string|null $key
     * @return array|string[]
     */
    public function getAvailableProperties() : array
    {
        return [
            'name' => 'subpage.subpage.name',
            'parent.name' => 'parent.subpage.subpage.name',
            'parent.parent.name' => 'parent.parent.subpage.subpage.name',
            'parent.parent.parent.name' => 'parent.parent.subpage.subpage.name',
            'idSubpage' => 'subpage.idSubpage',
            'idResource' => 'resource.idResource',
        ];
    }
}
