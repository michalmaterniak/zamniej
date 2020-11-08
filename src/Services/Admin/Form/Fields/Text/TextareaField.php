<?php
namespace App\Services\Admin\Form\Fields\Text;

use App\Services\Admin\Form\Fields\FormField;

class TextareaField extends FormField
{
    public function __construct(string $name, string $resource)
    {
        parent::__construct($name, $resource);
        $this->type('textarea');
    }
}
