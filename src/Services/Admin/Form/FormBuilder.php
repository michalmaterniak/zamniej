<?php
namespace App\Services\Admin\Form;

use App\Services\Admin\Form\Interfaces\FormBuilderInterface;
use App\Services\Admin\Form\Interfaces\FormFieldInterface;

abstract class FormBuilder implements FormBuilderInterface
{
    protected $form = [];
    protected $nameSection = 'basic';
    protected $subtabName = 'main';

    public function create(): self
    {
        $this->form = [];
        $this->nameSection = 'basic';
        $this->subtabName = 'main';
        return $this;
    }

    public function add(FormFieldInterface $field) : self
    {
        $this->form[$this->nameSection]['parts'][$this->subtabName]['fields'][] = $field->getField();

        return $this;
    }

    public function tab(string $tabName): FormBuilderInterface
    {
        $this->nameSection = $tabName;

        return $this;
    }

    public function subtab(string $name, string $key) : FormBuilderInterface
    {
        $this->subtabName = $key;
        $this->form[$this->nameSection]['parts'][$this->subtabName] = [
            'name' => $name,
            'index' => $key,
            'fields' => [],
        ];

        return $this;
    }
    public function basic($resource = 'modelEntity')
    {
        $this->nameSection = 'basic';
        $this->form[$this->nameSection]['options'] = [
            'resource' => $resource,
        ];
        $this->subtab('Podstawowe', 'main');

        return $this;
    }

    public function subpage($resource = 'modelEntity.subpages')
    {
        $this->nameSection = 'subpage';
        $this->form[$this->nameSection]['options'] = [
            'resource' => $resource,
        ];
        $this->subtab('Podstawowe', 'main');

        return $this;
    }

    public function seo($resource = 'modelEntity.subpages')
    {
        $this->nameSection = 'seo';
        $this->form[$this->nameSection]['options'] = [
            'resource' => $resource,
        ];
        $this->subtab('Podstawowe', 'main');


        return $this;
    }

    public function build(): array
    {
        return $this->form;
    }
}
