<?php
namespace App\DataFixtures\Affiliations;

use App\DataFixtures\Fixtures;
use App\Entity\Entities\Affiliations\Affiliations;

class AffiliationsFixtures extends Fixtures
{

    public function load()
    {
        $affiliation = new Affiliations('default');
        static::addFixture($affiliation, 'affiliation_default');
        $this->entityManager->persist($affiliation);


        $affiliation = new Affiliations('webepartners');
        static::addFixture($affiliation, 'affiliation_webe');
        $this->entityManager->persist($affiliation);


        $this->entityManager->flush();
    }
}
