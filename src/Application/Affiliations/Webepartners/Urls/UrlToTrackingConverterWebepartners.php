<?php

namespace App\Application\Affiliations\Webepartners\Urls;

use App\Application\Affiliations\Webepartners\Api\TrackingUrlWebepartners;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use Exception;

class UrlToTrackingConverterWebepartners
{
    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var TrackingUrlWebepartners $trackingUrlWebepartners
     */
    protected $trackingUrlWebepartners;

    public function __construct(
        WebepartnersProgramsRepository $webepartnersProgramsRepository,
        TrackingUrlWebepartners $trackingUrlWebepartners
    )
    {
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
        $this->trackingUrlWebepartners = $trackingUrlWebepartners;
    }

    /**
     * @param string $subpage
     * @return string|null
     * @todo pobierany jest pierwszy sklep z brzegu, po nazwie. moze jakis lepszy algorytm ?
     */
    public function getUrl(string $subpage): ?string
    {
        if (filter_var($subpage, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        $shopsCount = $this->webepartnersProgramsRepository->counting(false)->getActivePrograms()->byUrlProgram(parse_url($subpage, PHP_URL_HOST))->getCount();
        if ($shopsCount > 0) {
            try {
                return $this->trackingUrlWebepartners->getTrackingUrl($subpage);
            } catch (Exception $exception) {
            }
        }
        return null;
    }
}
