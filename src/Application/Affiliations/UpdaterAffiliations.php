<?php

namespace App\Application\Affiliations;

use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use App\Application\Affiliations\Webepartners\UpdaterWebepartners;
use Doctrine\Common\Collections\ArrayCollection;

class UpdaterAffiliations
{
    /**
     * @var ArrayCollection|UpdaterAffiliationInterface[] $updaterAffiliation
     */
    protected $updatersAffiliation;

    public function __construct(
        UpdaterWebepartners $updaterWebepartners
    )
    {
        $this->updatersAffiliation = new ArrayCollection();
        $this->register($updaterWebepartners);
    }

    protected function register(UpdaterAffiliationInterface $updaterAffiliation)
    {
        $this->updatersAffiliation->add($updaterAffiliation);
    }

    public function update()
    {
        foreach ($this->updatersAffiliation as $updaterAffiliation) {
            $updaterAffiliation->update();
        }
    }

}
