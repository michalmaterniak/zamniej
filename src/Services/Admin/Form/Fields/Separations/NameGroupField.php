<?php
namespace App\Services\Admin\Form\Fields\Separations;

use App\Services\Admin\Form\Fields\FormField;
use App\Services\Admin\Form\Interfaces\FormBuilderInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class NameGroupField extends FormField
{
    /**
     * @var FormBuilderInterface $fields
     * @Groups({"fields"})
     */
    protected $fields;
    protected $text;
    public function __construct(string $text, array $options = [])
    {
        parent::__construct('namegroup');
        $this->type('namegroup');
        $this->options = $options;
        $this->text = $text;
    }

    public function getText() : string
    {
        return $this->text;
    }
    public function getField()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'text' => $this->getText(),
            'options' => $this->getOptions(),
        ];
    }
}
