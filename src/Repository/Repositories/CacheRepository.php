<?php

namespace App\Repository\Repositories;

class CacheRepository extends GlobalRepository
{
    public function sideWide()
    {
        $this->setCacheEnable(true);
    }
}
