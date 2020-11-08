<?php


namespace App\Entity\Interfaces;

interface UpdateDatetimeInterface
{
    /**
     * @return \DateTime
     */
    public function getDatetimeUpdate(): \DateTime;

    /**
     * @param \DateTime $datetimeUpdate
     */
    public function setDatetimeUpdate(\DateTime $datetimeUpdate): void;
}
