<?php
namespace App\Application\Pages\Category\Seo;

use App\Application\Pages\Category\Seo\Elements\CategorySeoCanonical;
use App\Application\Pages\Category\Seo\Elements\CategorySeoDescription;
use App\Application\Pages\Category\Seo\Elements\CategorySeoHeader;
use App\Application\Pages\Category\Seo\Elements\CategorySeoTitle;
use App\Services\Seo\SeoElements;
use App\Repository\Repositories\Settings\SettingsRepository;

class CategorySeoElements extends SeoElements
{
    public function __construct(
        SettingsRepository  $settingsRepository,
        CategorySeoTitle        $seoTitle,
        CategorySeoHeader       $seoHeader,
        CategorySeoDescription  $seoDescription,
        CategorySeoCanonical    $seoCanonical
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
