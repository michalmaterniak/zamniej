<?php

namespace App\Application\Admin\Resources\Listing;

interface ListingResourceInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getName(): string;
}
