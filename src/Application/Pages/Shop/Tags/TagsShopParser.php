<?php
namespace App\Application\Pages\Shop\Tags;

use App\Application\Pages\Shop\ShopSubpage;

class TagsShopParser extends TagsShop
{
    public function getTag(ShopSubpage $subpage): ?string
    {
        return preg_replace("/({{\s*(name)\s*}})/", $subpage->getSubpage()->getName(), parent::getTag($subpage));
    }
}
