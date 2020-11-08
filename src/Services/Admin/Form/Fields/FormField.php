<?php
namespace App\Services\Admin\Form\Fields;

use App\Services\Admin\Form\Interfaces\FormFieldInterface;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class FormField implements FormFieldInterface
{
    protected $type;
    protected $name;
    protected $resource;
    protected $options;

    public function __construct(string $name, string $resource = null)
    {
        $this->name($name);
        $this->resource($resource);
    }

    public function name(string $name): FormFieldInterface
    {
        $this->name = $name;

        return $this;
    }

    protected function type(string $type): FormFieldInterface
    {
        $this->type = $type;

        return $this;
    }

    public function resource(?string $resource): FormFieldInterface
    {
        $this->resource = $resource;

        return $this;
    }

    public function options(array $options): FormFieldInterface
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }
    /**
     * @Groups({"fields"})
     */
    public function getField()
    {
        return [
            'name' => $this->getName(),
            'resource' => $this->getResource(),
            'type' => $this->getType(),
            'options' => $this->getOptions(),
        ];
    }
}
