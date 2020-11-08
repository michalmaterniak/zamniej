<?php
namespace App\Application\Pages\Page;

use App\Services\Pages\Resource\Resource;

/**
 * Class Page
 * @package App\Application\Pages\Page
 */
abstract class Page extends Resource
{
    public function __construct(
        PageSubpagesManager $resourceSubpagesManager,
        PageComponents $resourceComponents
    ) {
        parent::__construct($resourceSubpagesManager, $resourceComponents);
    }
}
