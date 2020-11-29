<?php

namespace App\Application\Affiliations;

use App\Application\Affiliations\Interfaces\FinderProgramsInterface;
use App\Application\Affiliations\Webepartners\FinderProgramsWebepartners;
use Doctrine\Common\Collections\ArrayCollection;

class UpdatePrograms
{
    /**
     * @var FinderProgramsInterface[] $findersRegistred
     */
    protected $findersRegistred;

    public function __construct(
        FinderProgramsWebepartners $finderProgramsWebepartners
    )
    {
        $this->findersRegistred = new ArrayCollection();
        $this->findersRegistred->add($finderProgramsWebepartners);
    }

    public function findPrograms()
    {
        foreach ($this->findersRegistred as $finderPrograms) {
            $finderPrograms->find();
        }
    }
}
