<?php
namespace App\Services\Admin\Form\Interfaces;

interface FormFieldInterface
{
    public function name(string $name) : self;
    public function resource(?string $resource) : self;
    public function options(array $options) : self;

    public function getField();
}
