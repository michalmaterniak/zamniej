<?php
namespace App\Services\Seo\Interfaces;

interface SeoInterface
{
    public function getTitle() : string;
    public function getHeader() : string;
    public function getDescription() : string;
}
