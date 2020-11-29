<?php
namespace App\Application\Affiliations\Webepartners\Api\Programs;

use App\Application\Affiliations\Interfaces\Programs\FinderProgramsInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;

class ProgramsWebepartners extends Webepartners implements FinderProgramsInterface
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetPrograms';
    }

    /**
     * @return mixed|void
     */
    public function getPrograms()
    {
        return $this->getResponse();
    }
}
