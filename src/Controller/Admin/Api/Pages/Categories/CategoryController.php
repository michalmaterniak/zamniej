<?php
namespace App\Controller\Admin\Api\Pages\Categories;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Category\Category;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Services\Admin\Form\Fields\Files\PhotoField;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;

class CategoryController extends AbstractResourceController
{
    public function item(Category $resource, FormBuilderResources $formBuilder)
    {
        $form = $formBuilder
            ->create()
                ->basic()
                    ->add(new TextField('Nazwa', 'name'))
                    ->add(new PhotoField('Logo', 'files', 'logo'))
                    ->add(new TextField('Ikonka', 'content.extra.icon'))
                ->subpage()
                    ->add(new TextField('Nazwa', 'name'))
                    ->add(new WysiwygField('Treść', 'content.content'))
                ->seo()
                    ->add(new TextareaField('Tytuł', 'title'))
                    ->add(new TextareaField('Nagłówek H1', 'header'))
                    ->add(new TextareaField('Meta description', 'description'))
        ;

        $this->templateVars->insert('form', $this->normalizer->normalize($form->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }
}
