<?php

namespace App\Application\Affiliations\Convertiser\Api\Programs;

use App\Application\Affiliations\Convertiser\Api\Convertiser;
use App\Application\Affiliations\Interfaces\Programs\FinderProgramsInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ProgramsConvertiser extends Convertiser implements FinderProgramsInterface
{
    /**
     * @return ArrayCollection
     */
    public function getPrograms(): ArrayCollection
    {
        $programs = [];
        $url = $this->getUrl();

        do {
            $data = $this->getResponse(['url' => $url]);
            $programs = array_merge($programs, $data['results']);
            $url = $data['next'];
        } while ($url);

        return new ArrayCollection($programs);
    }

    protected function getUrl(): string
    {
        return '/publisher/offers/';
    }
}
