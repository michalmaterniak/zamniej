<?php
namespace App\Application\Pages\Page\Types\Promotions;

use App\Application\Pages\Page\Page;

/**
 * Class Promotions
 * @package App\Application\Pages\Page\Types\Promotions
 * @method PromotionsSubpage getSubpage(string $locale = null) : ResourceSubpage
 */
class Promotions extends Page
{
    public function __construct(
        PromotionsSubpagesManager $resourceSubpagesManager,
        PromotionsComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
