<?php
namespace App\Services\Admin\Form\Fields\Files;

use App\Services\Admin\Form\Fields\FormField;

class UploadField extends FormField
{
    public function __construct(string $name, string $resource)
    {
        parent::__construct($name, $resource);
        $this->type('upload');
    }
}
