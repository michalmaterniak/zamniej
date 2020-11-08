<?php
namespace App\Application\SiteWide;

interface FrontInitInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return mixed
     */
    public function getValue();
}
