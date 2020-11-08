<?php
namespace App\Application\Pages\Homepage\Seo;

use App\Application\Pages\Homepage\Seo\Elements\HomepageSeoCanonical;
use App\Application\Pages\Homepage\Seo\Elements\HomepageSeoDescription;
use App\Application\Pages\Homepage\Seo\Elements\HomepageSeoHeader;
use App\Application\Pages\Homepage\Seo\Elements\HomepageSeoTitle;
use App\Services\Seo\SeoElements;
use App\Repository\Repositories\Settings\SettingsRepository;

class HomepageSeoElements extends SeoElements
{
    public function __construct(
        SettingsRepository  $settingsRepository,
        HomepageSeoTitle        $seoTitle,
        HomepageSeoHeader       $seoHeader,
        HomepageSeoDescription  $seoDescription,
        HomepageSeoCanonical    $seoCanonical
    ) {
        parent::__construct($settingsRepository, $seoTitle, $seoHeader, $seoDescription, $seoCanonical);
    }

    /**
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
