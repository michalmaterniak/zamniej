<?php
namespace App\Application\Admin\Resources\Item\Form\Fields\Shops;

use App\Services\Admin\Form\Fields\FormField;

class ShopSubpageAffiliations extends FormField
{
    public function __construct()
    {
        parent::__construct('shop-affiliations');
        $this->type('shop-affiliations');
    }
}
