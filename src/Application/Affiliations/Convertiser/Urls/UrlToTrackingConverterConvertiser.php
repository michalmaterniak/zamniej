<?php

namespace App\Application\Affiliations\Convertiser\Urls;

use App\Application\Affiliations\Convertiser\Api\TrackingUrlConvertiser;
use App\Application\Affiliations\Interfaces\Urls\UrlTrackingConverterInterface;
use App\Repository\Repositories\Affiliations\Convertiser\ConvertiserProgramsRepository;
use Exception;

class UrlToTrackingConverterConvertiser implements UrlTrackingConverterInterface
{
    /**
     * @var ConvertiserProgramsRepository $convertiserProgramsRepository
     */
    protected $convertiserProgramsRepository;

    /**
     * @var TrackingUrlConvertiser $trackingUrlConvertiser
     */
    protected $trackingUrlConvertiser;

    public function __construct(
        ConvertiserProgramsRepository $convertiserProgramsRepository,
        TrackingUrlConvertiser $trackingUrlConvertiser
    )
    {
        $this->convertiserProgramsRepository = $convertiserProgramsRepository;
        $this->trackingUrlConvertiser = $trackingUrlConvertiser;
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

        $programs = $this->convertiserProgramsRepository->select(false)->getActivePrograms()->byUrlProgram(parse_url($subpage, PHP_URL_HOST))->getResults();
        dump($programs);
        if (count($programs) > 0) {
            try {
                $program = $programs[0];
                return $this->trackingUrlConvertiser->getTrackingUrl(
                    $program->getExternalId(),
                    $program->getAffiliation()->getData('website'),
                    $subpage
                );
            } catch (Exception $exception) {
            }
        }
        return null;
    }
}
