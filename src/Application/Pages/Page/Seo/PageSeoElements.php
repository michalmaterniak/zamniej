<?php
namespace App\Application\Pages\Page\Seo;

use App\Application\Pages\Page\Seo\Elements\PageSeoCanonical;
use App\Application\Pages\Page\Seo\Elements\PageSeoDescription;
use App\Application\Pages\Page\Seo\Elements\PageSeoHeader;
use App\Application\Pages\Page\Seo\Elements\PageSeoTitle;
use App\Services\Seo\SeoElements;
use App\Repository\Repositories\Settings\SettingsRepository;

class PageSeoElements extends SeoElements
{
    public function __construct(
        SettingsRepository  $settingsRepository,
        PageSeoTitle        $seoTitle,
        PageSeoHeader       $seoHeader,
        PageSeoDescription  $seoDescription,
        PageSeoCanonical    $seoCanonical
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
            'idSubpage' => 'subpage.subpage.idSubpage',
            'idResource' => 'resource.idResource',
        ];
    }
}
