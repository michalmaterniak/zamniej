<?php
namespace App\Services\System\Request\Retrievers\Interfaces;

interface RequestDataInterface
{
    public function getValue(string $id, $defaultIfNotExistReturn = null);
    public function checkIfExist(string $id) : bool;
}
