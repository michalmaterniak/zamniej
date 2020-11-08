<?php
namespace App\Application\Admin\Resources\Item\Form\Fields\Shops;

use App\Services\Admin\Form\Fields\FormField;

class ShopSubpageShopTagsField extends FormField
{
    public function __construct()
    {
        parent::__construct('shop-tags');
        $this->type('shop-tags');
    }
}
