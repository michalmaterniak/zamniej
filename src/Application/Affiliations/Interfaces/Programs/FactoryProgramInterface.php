<?php

namespace App\Application\Affiliations\Interfaces\Programs;

use App\Entity\Entities\Affiliations\ShopsAffiliation;

interface FactoryProgramInterface
{
    public function createProgram(): ShopsAffiliation;
}
