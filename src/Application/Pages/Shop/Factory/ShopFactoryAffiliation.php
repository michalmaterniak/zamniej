<?php
namespace App\Application\Pages\Shop\Factory;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Resources;

/**
 * Class ShopFactoryAffiliation
 * @package App\Application\Pages\Shop\Factory
 */
class ShopFactoryAffiliation extends ShopFactory
{
    /**
     * @var ShopsAffiliation $program
     */
    protected $program;
    public function afterCreateSubpage(): void
    {
        parent::afterCreateSubpage();
        $this->tieWithShopAffiliation();
    }

    public function createByAffiliate(ShopsAffiliation $program, Resources $category) : ShopFactory
    {
        $this->program = $program;
        return $this->create($program->getName(), $category, ['logo' => $program->getUrlLogo()]);
    }

    protected function tieWithShopAffiliation()
    {
        $this->program->setSubpage($this->currentSubpage);
        $this->entityManager->flush();
    }
}
