<?php
namespace App\Twig\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface TemplateInterface
{
    /**
     * @param $key
     * @param $value
     */
    public function insert(string $key, $value): void;

    /**
     * @return ArrayCollection
     */
    public function getVars(): ArrayCollection;

    public function getVar(string $key);
}
