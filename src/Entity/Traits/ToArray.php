<?php


namespace App\Entity\Traits;

use App\Entity\Interfaces\ArrayInterfaces;
use DateTime;

trait ToArray
{
    public static function propertiesToNormalize() : array
    {
        return [
        ];
    }


    public function toArray()
    {
        $array = [];
        foreach (get_object_vars($this) as $key => $item) {
            if (in_array($key, static::propertiesToNormalize())) {
                if ($item != null && is_object($item) && $item instanceof ArrayInterfaces) {
                    $array[$key] = $item->toArray();
                } elseif ($item != null && is_object($item) && $item instanceof DateTime) {
                    $array[$key] = $item->getTimestamp();
                } else {
                    $array[$key] = $item;
                }
            }
        }

        return $array;
    }
}
