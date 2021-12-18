<?php

namespace App\Application\Affiliations;

use App\Application\Affiliations\Convertiser\UpdaterConvertiser;
use App\Application\Affiliations\Interfaces\UpdaterAffiliationInterface;
use App\Application\Affiliations\Tradetracker\UpdaterTradetracker;
use App\Application\Affiliations\Webepartners\UpdaterWebepartners;
use Doctrine\Common\Collections\ArrayCollection;

class UpdaterAffiliations
{
    /**
     * @var ArrayCollection|UpdaterAffiliationInterface[] $updaterAffiliation
     */
    protected $updatersAffiliation;

    public function __construct(
        UpdaterWebepartners $updaterWebepartners,
        UpdaterConvertiser $updaterConvertiser,
        UpdaterTradetracker $updaterTradetracker
    )
    {
//        $this->register($updaterConvertiser);
//        $this->register($updaterWebepartners);
        $this->register($updaterTradetracker);
    }

    protected function register(UpdaterAffiliationInterface $updaterAffiliation)
    {
        if ($this->updatersAffiliation === null) {
            $this->updatersAffiliation = new ArrayCollection();
        }
        $this->updatersAffiliation->add($updaterAffiliation);
    }

    public function update()
    {
        foreach ($this->updatersAffiliation as $updaterAffiliation) {
            $updaterAffiliation->update();
        }
    }

}
