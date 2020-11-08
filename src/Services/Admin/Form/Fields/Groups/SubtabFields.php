<?php
namespace App\Services\Admin\Form\Fields\Groups;

use App\Services\Admin\Form\Fields\FormField;
use App\Services\Admin\Form\Interfaces\FormBuilderInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class SubtabFields extends FormField
{
    /**
     * @var FormBuilderInterface $fields
     * @Groups({"fields"})
     */
    protected $fields;
    public function __construct(string $name, FormBuilderInterface $fields)
    {
        parent::__construct($name);
        $this->type('subtab');
        $this->fields = $fields;
        $this->fields->create();
    }
    public function getField()
    {
        return array_merge(parent::getField(), [
            'fields' => $this->fields->build(),
        ]);
    }
}
