<?php
namespace App\Application\Pages\Shop;

use App\Application\Offers\Offer;
use App\Application\Offers\Types\OfferProduct;
use App\Application\Offers\Types\OfferPromotion;
use App\Application\Offers\Types\OfferVoucher;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersProduct;
use App\Entity\Entities\Shops\Opinions\ShopOpinions;
use App\Entity\Entities\Shops\Tags\ShopTagsTranslate;
use App\Services\Pages\Resource\ResourceSubpage;
use App\Services\Photos\Photo;
use App\Services\Photos\PhotoModify;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ShopSubpage
 * @package App\Application\Pages\Shop
 * @method ShopComponents getComponents() : ResourceComponents
 * @method Shop getResource() : Resource
 */
class ShopSubpage extends ResourceSubpage
{
    /**
     * @var Offer[]|ArrayCollection $offers
     */
    private $offers;

    /**
     * @var Photo
     */
    private $photo;

    /**
     * @var ShopsAffiliation $affiliation
     */
    private $affiliation;

    /**
     * @var ShopOpinions[]|ArrayCollection $comments
     */
    private $comments;

    /**
     * @var ShopTagsTranslate
     */
    private $tag;

    public function __construct(
        ShopComponents $components
    ) {
        parent::__construct($components);
    }

    public function getAffiliation()
    {
        if (!$this->affiliation) {
            $this->getComponents()->getChoiseAffiliation()->loadAffiliations(
                $this->getComponents()->getShopsAffiliationRepository()->select()->bySubpage($this->getSubpage())->getResults()
            );

            $this->affiliation = $this->getComponents()->getChoiseAffiliation()->getShopAffiliation();
        }
        return $this->affiliation;
    }

    /**
     * @return Offer[]|Offers[]|ArrayCollection
     */
    public function getOffers()
    {
        if (!$this->offers) {
            $this->offers = $this->getComponents()->getOffersManager()->createModelsOffers(
                $this->getComponents()->getOffersRepository()->select()->findOffersBySubpage($this->getSubpage(), 'datetimeCreate', 'DESC')->getResults()
            );
        }

        return $this->offers;
    }

    /**
     * @return OfferVoucher[]|OfferPromotion[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getOffersPromo()
    {
        return $this->getOffers()->filter(function (Offer $offer) {
            return $offer instanceof OfferPromotion || $offer instanceof OfferVoucher;
        })->getValues();
    }

    /**
     * @return Photo
     * @Groups("resource")
     */
    public function getPhoto()
    {
        if (!$this->photo) {
            $this->photo = $this->getComponents()->getPhoto()->createModelPhoto(
                $this->getSubpage()->getPhoto('logo')
            );
        }

        return $this->photo;
    }

    /**
     * @return PhotoModify
     * @Groups("resource")
     */
    public function getLogo()
    {
        return $this->getPhoto()->getModifiedPhoto('insertCenter', 270, 200, [
            'position' => 'center'
        ]);

    }

    /**
     * @return OffersProduct[]|ArrayCollection
     * @Groups("resource")
     */
    public function getProducts()
    {
        return $this->getOffers()->filter(function (Offer $offer) {
            return $offer instanceof OfferProduct;
        });
    }

    /**
     * @return string
     * @Groups("resource")
     */
    public function getUrlTracking() : string
    {
        return $this->getComponents()->getRouter()->generate('page-pages-redirect-shop', ['shop' => $this->getAffiliation()->getIdShop()], RouterInterface::ABSOLUTE_URL);
    }

    /**
     * @return ShopOpinions[]|ArrayCollection
     * @Groups("resource")
     */
    public function getOpinions()
    {
        if (!$this->comments) {
            $this->comments = $this->getComponents()->getShopOpinionsRepository()->select()->bySubpage($this->getSubpage())->getResults();
        }

        return $this->comments;
    }

    /**
     * @return ShopTagsTranslate
     * @Groups("resource")
     */
    public function getTag()
    {
        if (!$this->tag) {
            $this->tag = $this->getComponents()->getTagsShopParser()->getTag($this);
        }
        return $this->tag;
    }

    /**
     * @return int
     * @Groups("resource")
     */
    public function getIdShopAffil()
    {
        return $this->getAffiliation()->getIdShop();
    }
}
