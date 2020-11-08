<?php
namespace App\Services\Admin\Form\Fields\Files;

use App\Services\Admin\Form\Fields\FormField;

class PhotoField extends FormField
{
    public function __construct(string $name, string $resource, string $group)
    {
        parent::__construct($name, $resource);
        $this->type('photo');
        $this->options['group'] = $group;
    }
}
