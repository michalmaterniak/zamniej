<?php
namespace App\Application\Admin\Resources\Item\Form;

use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;
use App\Services\Admin\Form\FormBuilder as GlobalFormBuilder;

class FormBuilderResources extends GlobalFormBuilder
{
    public function __construct()
    {
        $this
            ->create()
                ->basic()
                    ->add(new TextField('Nazwa', 'name'))
                ->subpage()
                    ->add(new TextField('Nazwa', 'name'))
                    ->add(new WysiwygField('Treść', 'content.content'))

                ->seo()
                    ->add(new TextareaField('Tytuł', 'title'))
                    ->add(new TextareaField('Nagłówek H1', 'header'))
                    ->add(new TextareaField('Meta description', 'description'))
        ;
    }
}
