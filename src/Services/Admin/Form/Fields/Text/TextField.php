<?php
namespace App\Services\Admin\Form\Fields\Text;

use App\Services\Admin\Form\Fields\FormField;

class TextField extends FormField
{
    public function __construct(string $name, string $resource)
    {
        parent::__construct($name, $resource);
        $this->type('text');
    }
}
