<?php
namespace App\Application\Pages\Page\Types\Promotions;

use App\Application\Pages\Page\PageConfig;

class PromotionsConfig extends PageConfig
{
    /**
     * @var string $key
     */
    protected $key = 1;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Promotions::class;

    /**
     * @var null $child
     */
    protected $child = null;

    /**
     * @var string $controller
     */
    protected $controller = "Pages\\Promotions\\Promotions";

    /**
     * @var string
     */
    protected $name = "Strona z promocjami";
}
