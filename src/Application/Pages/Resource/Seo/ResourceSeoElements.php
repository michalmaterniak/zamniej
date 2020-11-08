<?php
namespace App\Application\Pages\Resource\Seo;

use App\Application\Pages\Shop\Seo\Elements\ShopSeoCanonical;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoDescription;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoHeader;
use App\Application\Pages\Shop\Seo\Elements\ShopSeoTitle;
use App\Services\Seo\SeoElements;
use App\Repository\Repositories\Settings\SettingsRepository;

class ResourceSeoElements extends SeoElements
{
    public function __construct(
        SettingsRepository  $settingsRepository,
        ShopSeoTitle        $seoTitle,
        ShopSeoHeader       $seoHeader,
        ShopSeoDescription  $seoDescription,
        ShopSeoCanonical    $seoCanonical
    ) {
        parent::__construct($settingsRepository, $seoTitle, $seoHeader, $seoDescription, $seoCanonical);
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
