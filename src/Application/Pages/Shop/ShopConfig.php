<?php
namespace App\Application\Pages\Shop;

use App\Entity\Entities\Shops\Shops;
use App\Services\Pages\Resource\ResourceConfig;

class ShopConfig extends ResourceConfig
{
    /**
     * @var int $key
     */
    protected $key = 7;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Shop::class;

    /**
     * @var null $child
     */
    protected $child = null;

    /**
     * @var string $entityClass
     */
    protected $entityClass = Shops::class;

    /**
     * @var string $controller
     */
    protected $controller = "Shops\\Shop";

    /**
     * @var string
     */
    protected $name = "Program / Sklep";
}
