<?php
namespace App\Application\Pages\Page\Types\Shops;

use App\Application\Pages\Page\PageConfig;

/**
 * Class ShopsConfig
 * @package App\Application\Pages\Page\Types\Shops
 */
class ShopsConfig extends PageConfig
{
    /**
     * @var int $key
     */
    protected $key = 2;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Shops::class;

    /**
     * @var null $child
     */
    protected $child = null;

    /**
     * @var string $controller
     */
    protected $controller = "Shops\\Shops";

    /**
     * @var string
     */
    protected $name = "Strona ze sklepami";
}
