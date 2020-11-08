<?php
namespace App\Services\Admin\Form\Fields\Separations;

use App\Services\Admin\Form\Fields\FormField;
use App\Services\Admin\Form\Interfaces\FormBuilderInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class LineSeparationField extends FormField
{
    /**
     * @var FormBuilderInterface $fields
     * @Groups({"fields"})
     */
    protected $fields;
    public function __construct(array $options = [])
    {
        parent::__construct('lineseparation');
        $this->type('lineseparation');
        $this->options = $options;
    }
    public function getField()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'options' => $this->getOptions(),
        ];
    }
}
