<?php
namespace App\Entity\Interfaces;

use DateTime;

interface UpdateDatetimeInterface
{
    /**
     * @return DateTime
     */
    public function getDatetimeUpdate(): DateTime;

    /**
     * @param DateTime $datetimeUpdate
     */
    public function setDatetimeUpdate(DateTime $datetimeUpdate): void;
}
