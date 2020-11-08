<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Pages\Page\Page;

/**
 * Class Shops
 * @package App\Application\Pages\Page\Types\Shops
 * @method ShopsSubpage getSubpage(string $locale = null) : ResourceSubpage
 */
class Shops extends Page
{
    public function __construct(
        ShopsSubpagesManager $resourceSubpagesManager,
        ShopsComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
