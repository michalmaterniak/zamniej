<?php
namespace App\Entity\Interfaces;

interface ArrayInterfaces
{
    public function toArray();
    public static function propertiesToNormalize() : array;
}
