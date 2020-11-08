<?php
namespace App\Application\Pages\Page;

use App\Entity\Entities\Pages\Pages;
use App\Services\Pages\Resource\ResourceConfig;

abstract class PageConfig extends ResourceConfig
{
    /**
     * @var null $key
     */
    protected $key = null;

    /**
     * @var null|string $modelClass
     */
    protected $modelClass = null;

    /**
     * @var null|string $child
     */
    protected $child = null;

    /**
     * @var string $entityClass
     */
    protected $entityClass = Pages::class;

    /**
     * @var null|string $controller
     */
    protected $controller = null;

    /**
     * @var string
     */
    protected $name = "Strona";
}
