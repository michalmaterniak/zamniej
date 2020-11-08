<?php
namespace App\Application\Pages\Homepage;

use App\Entity\Entities\Homepages\Homepages;
use App\Services\Pages\Resource\ResourceConfig;

/**
 * Class HomepageConfig
 * @package App\Services\Pages\Homepage
 */
class HomepageConfig extends ResourceConfig
{
    /**
     * @var int
     */
    protected $key = 0;

    /**
     * @var string $modelClass
     */
    protected $modelClass = Homepage::class;

    /**
     * @var int $child
     */
    protected $child = null;

    /**
     * @var array|int[] $typeChild
     */
    protected $availableTypesChildren = [1, 2, 3, 4];

    /**
     * @var string $entityClass
     */
    protected $entityClass = Homepages::class;

    /**
     * @var string $controller
     */
    protected $controller = 'Homepages\\Homepage';

    /**
     * @var string
     */
    protected $name = "Strona Główna";

    /**
     * @param int $child
     */
    public function setChild(int $child): void
    {
        $this->child = $child;
    }
}
