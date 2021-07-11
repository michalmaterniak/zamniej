<?php
namespace App\Controller\Admin\Api\Pages\Shops;

use App\Application\Admin\Resources\Item\Form\Fields\Shops\ShopSubpageOffersField;
use App\Application\Admin\Resources\Item\Form\Fields\Shops\ShopSubpageShopTagsField;
use App\Application\Admin\Resources\Item\Form\FormBuilderResources;
use App\Application\Pages\Shop\Affiliations\ActiveAffiliation;
use App\Application\Pages\Shop\Shop;
use App\Controller\Admin\Api\Pages\AbstractResourceController;
use App\Entity\Entities\Shops\Shops;
use App\Entity\Entities\Shops\Tags\ShopTags;
use App\Services\Admin\Form\Fields\Files\PhotoField;
use App\Services\Admin\Form\Fields\Separations\LineSeparationField;
use App\Services\Admin\Form\Fields\Separations\NameGroupField;
use App\Services\Admin\Form\Fields\Text\NumericField;
use App\Services\Admin\Form\Fields\Text\TextareaField;
use App\Services\Admin\Form\Fields\Text\TextField;
use App\Services\Admin\Form\Fields\Text\WysiwygField;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ShopController extends AbstractResourceController
{
    /**
     * @param Shops    $shop
     * @param ShopTags $tag
     * @Route("/admin/api/pages/shops/shop/tag/{shop}/{tag}", name="admin-api-pages-shops-shop-tag", methods={"POST"}, requirements={"shopTag": "\d+"})
     */
    public function tag(Shops $shop, ShopTags $tag)
    {
        try {
            $shop->setTag($tag);
            $this->getDoctrine()->getManager()->flush();

            return $this->json([
                'success' => true,
                'message' => 'Przypisano tag do sklepu',
                'tag' => $this->normalizer->normalize($tag, null, [
                    'groups' => ["resource-admin"],
                ]),
            ]);
        } catch (ErrorException $exception) {
            return $this->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * @param FormBuilderResources $formBuilderResources
     * @return FormBuilderResources
     */
    private function createFormResource(FormBuilderResources $formBuilderResources): FormBuilderResources
    {
        return $formBuilderResources
            ->create()
            ->basic()
            ->add(new TextField('Nazwa', 'name'))
            ->subtab('Ocena', 'rating')
            ->add(new TextField('Ocena', 'content.extra.details.rating.rating'))
            ->add(new NumericField('Ilość ocen', 'content.extra.details.rating.count'))
            ->subtab('Tagi', 'tags')
            ->add(new ShopSubpageShopTagsField())
            ->subpage()
            ->add(new TextField('Nazwa', 'name'))
            ->add(new WysiwygField('Treść', 'content.content'))
            ->add(new TextareaField('Krótka treść', 'content.extra.description'))
            ->add(new PhotoField('Logo', 'files', 'logo'))
            ->subtab('Szczegóły', 'details')
            ->add(new NameGroupField("Adres"))
            ->add(new TextField('Ulica i numer', 'content.extra.details.address.street'))
            ->add(new TextField('Miejscowość', 'content.extra.details.address.location'))
            ->add(new LineSeparationField())
            ->add(new NameGroupField("Kontakt"))
            ->add(new LineSeparationField())
            ->add(new TextField('Telefon', 'content.extra.details.contact.phone'))
            ->add(new TextField('Email', 'content.extra.details.contact.email'))
            ->add(new TextField('WWW', 'content.extra.details.contact.www'))
            ->add(new LineSeparationField())
            ->subtab('Oferty', 'offers')
            ->add(new ShopSubpageOffersField())
            ->seo()
            ->add(new TextareaField('Tytuł', 'title'))
            ->add(new TextareaField('Nagłówek H1', 'header'))
            ->add(new TextareaField('Meta description', 'description'));
    }

    /**
     * @param Shop $resource
     * @param FormBuilderResources $formBuilderResources
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function item(Shop $resource, FormBuilderResources $formBuilderResources)
    {
        $resource->setModelResource();

        $this->templateVars->insert('form', $this->normalizer->normalize($this->createFormResource($formBuilderResources)->build()));
        $this->templateVars->insert('resource', $this->normalizer->normalize($resource, null, [
            'groups' => ["resource-admin"],
        ]));

        return $this->responseJson();
    }

    public function active(bool $active, Shop $resource, ActiveAffiliation $activeAffiliation)
    {
        $activeAffiliation->setActivityAffiliations($active, $resource->getSubpage()->getSubpage());

        $resource->getSubpage()->getSubpage()->setActive($active);
        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'status' => true,
            'resource' => $this->normalizer->normalize($resource, null, [
                'groups' => 'resource-admin',
            ]),
            'active' => $resource->getSubpage()->getSubpage()->isActive()
        ]);
    }

    /**
     * @param FormBuilderResources $formBuilderResources
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function form(FormBuilderResources $formBuilderResources)
    {
        $this->templateVars->insert('form', $this->normalizer->normalize($this->createFormResource($formBuilderResources)->build()));
        return $this->responseJson();
    }
}
