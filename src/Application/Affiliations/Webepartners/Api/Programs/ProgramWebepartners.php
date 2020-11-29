<?php
namespace App\Application\Affiliations\Webepartners\Api\Programs;

use App\Application\Affiliations\Interfaces\Programs\FinderProgramInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;

class ProgramWebepartners extends Webepartners implements FinderProgramInterface
{

    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetSingleProgram';
    }

    /**
     * @param int $idProgram
     * @return array
     */
    public function getProgram($idProgram)
    {
        return $this->getResponse(['programId' => $idProgram]);
    }
}
