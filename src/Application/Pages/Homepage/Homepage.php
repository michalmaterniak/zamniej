<?php
namespace App\Application\Pages\Homepage;

use App\Entity\Entities\Homepages\Homepages;
use App\Services\Pages\Resource\Resource;

/**
 * Class Homepage
 * @package App\Services\Pages\Homepage
 *
 * @method Homepages getResource() : Homepages
 * @method HomepageComponents getComponents() : ResourceComponents
 */
class Homepage extends Resource
{
    public function __construct(
        HomepageSubpagesManager $homepageResourceSubpagesManager,
        HomepageComponents $homepageComponents
    ) {
        parent::__construct($homepageResourceSubpagesManager, $homepageComponents);
    }

}
