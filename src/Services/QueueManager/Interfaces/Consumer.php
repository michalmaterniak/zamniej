<?php
namespace App\Services\QueueManager\Interfaces;

interface Consumer
{
    public function run(array $data = []): void;
}
