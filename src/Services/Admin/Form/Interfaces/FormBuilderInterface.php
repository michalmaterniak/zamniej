<?php
namespace App\Services\Admin\Form\Interfaces;

interface FormBuilderInterface
{
    public function create() : self;
    public function add(FormFieldInterface $field) : self;
    public function tab(string $tabName) : self;
    public function subtab(string $tabName, string $key) : self;
    public function build() : array;
}
