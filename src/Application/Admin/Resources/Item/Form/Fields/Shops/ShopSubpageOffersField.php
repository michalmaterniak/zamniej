<?php
namespace App\Application\Admin\Resources\Item\Form\Fields\Shops;

use App\Services\Admin\Form\Fields\FormField;

class ShopSubpageOffersField extends FormField
{
    public function __construct()
    {
        parent::__construct('shop-offers');
        $this->type('shop-offers');
    }
}
