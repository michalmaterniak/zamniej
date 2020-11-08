<?php
namespace App\Controller\Admin\Api\Pages\Pages\Blog;

use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Page\Page;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Services\Admin\Form\Fields\Files\PhotoField;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;

class ArticleController extends AbstractResourceController
{
    public function item(Page $resource, FormBuilderResources $formBuilder)
    {
        $form = $formBuilder
            ->create()
                ->basic()
                    ->add(new TextField('Nazwa', 'name'))
            ->subpage()
                    ->add(new TextField('Nazwa', 'name'))
                    ->add(new WysiwygField('Treść', 'content.content'))
                    ->add(new PhotoField('Zdjęcie nagłówek', 'header', 'header'))

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
