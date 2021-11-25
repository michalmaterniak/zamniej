<?php
namespace App\Application\Pages\Homepage;

use App\Application\Offers\Offer;
use App\Application\Offers\Types\OfferPromotion;
use App\Application\Offers\Types\OfferVoucher;
use App\Application\Sliders\Slide;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use App\Entity\Entities\Sliders\Sliders;
use App\Repository\Repositories\Sliders\SlidersRepository;
use App\Services\Pages\Resource\ResourceSubpage;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class HomepageSubpage
 * @package App\Application\Pages\Homepage
 * @method HomepageComponents getComponents() : ResourceComponents
 */
class HomepageSubpage extends ResourceSubpage
{
    /**
     * @var SlidersRepository $slidersRepository
     */
    private $slidersRepository;
    /**
     * @var ArrayCollection|ArrayCollection[]|Sliders[][]
     */
    private $sliders;

    /**
     * @var Slide[]|ArrayCollection
     */
    private $mainSlider;

    /**
     * @var OfferPromotion[]|ArrayCollection
     */
    private $promotions;

    /**
     * @var OfferVoucher[]|ArrayCollection
     */
    private $vouchers;

    /**
     * @var ArrayCollection $shops
     */
    private $shops;

    /**
     * @var ArrayCollection $blog
     */
    private $blog;

    public function __construct(HomepageComponents $components)
    {
        parent::__construct($components);
    }

    /**
     * @return Offer[]|OfferPromotion[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getPromotions()
    {
        if(!$this->promotions) {

            $promotions = $this->getComponents()->getOffersManager()->createModelsOffers(
                $this->getComponents()->getOffersRepository()->select()->listingHomepage()->getTypeOffer(OffersPromotion::class)->getResults()
            );

            $this->promotions = new ArrayCollection();

            foreach ($promotions as $promotion) {
                $this->promotions->add([
                    'idOffer' => $promotion->getOffer()->getIdOffer(),
                    'title' => $promotion->getOffer()->getTitle(),
                    'slug' => $this->getComponents()->getResourcesManager()->loadEntity(
                        $promotion->getOffer()->getSubpage()->getResource()
                    )->getSubpage()->getSlug(),
                    'shop' => $promotion->getOffer()->getSubpage()->getName(),
                    'logo' => $promotion->getPhoto()->getModifiedPhoto('insertCenter', 292, 292),
                ]);
            }
        }
        return $this->promotions;
    }

    /**
     * @param int $max
     * @return ArrayCollection
     * @Groups({"resource"})
     */
    public function getShopsPopular()
    {
        if (!$this->shops) {
            $shopsResources = new ArrayCollection();
            foreach (
                $this->getComponents()->getShopAffiliationRepository()->select()->getPopular(
                    $this->getSubpage()->getData('config.amountPopularShops', 8)
                )->getResults()
                as $shopAffiliation) {

                if (!$shopAffiliation->getSubpage()) {
                    continue;
                }

                $shopsResources->add($shopAffiliation->getSubpage()->getResource());
            }

            $shops = $this->getComponents()->getResourcesManager()->loadShops($shopsResources);
            $this->shops = new ArrayCollection();
            foreach ($shops as $shop) {
                $this->shops->add([
                    'name' => $shop->getSubpage()->getSubpage()->getName(),
                    'logo' => $shop->getSubpage()->getPhoto()->getModifiedPhoto('insertCenter', 262, 116, ['background' => '#ffffff', 'margin-horizontal' => 40, 'margin-vertical' => 20]),
                    'slug' => $shop->getSubpage()->getSlug()
                ]);
            }
        }
        return $this->shops;
    }

    /**
     * @param int $max
     * @return ArrayCollection
     * @Groups({"resource"})
     */
    public function getBlogLatest(int $max = 4)
    {
        if (!$this->blog) {
            $articles = $this->getComponents()->getResourcesManager()->loadBlogArticles(
                $this->getComponents()->getBlogArticleRepository()->select()->getLatest($max)->active()->getResults()
            );
            $this->blog = new ArrayCollection();
            foreach ($articles as $article) {
                $this->blog->add([
                    'name' => $article->getSubpage()->getSubpage()->getName(),
                    'logo' => $article->getSubpage()->getPhoto()->getModifiedPhoto('fit', 320, 320),
                    'slug' => $article->getSubpage()->getSlug(),
                    'date' => $article->getSubpage()->getSubpage()->getDatetimeCreate(),
                ]);
            }
        }
        return $this->blog;
    }

    /**
     * @return Offer[]|OfferVoucher[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getVouchers()
    {
        if (!$this->vouchers) {
            $vouchers = $this->getComponents()->getOffersManager()->createModelsOffers(
                $this->getComponents()->getOffersRepository()->select()->listingHomepage()->getTypeOffer(OffersVoucher::class)->getResults()
            );

            $this->vouchers = new ArrayCollection();
            foreach ($vouchers as $voucher) {
                $this->vouchers->add([
                    'idOffer' => $voucher->getOffer()->getIdOffer(),
                    'slug' => $this->getComponents()->getResourcesManager()->loadEntity(
                        $voucher->getOffer()->getSubpage()->getResource()
                    )->getSubpage()->getSlug(),
                    'title' => $voucher->getOffer()->getTitle(),
                    'content' => $voucher->getOffer()->getContent()->getContent(),
                    'logo' => $voucher->getPhoto()->getModifiedPhoto('insertCenter', 292, 292),
                ]);
            }
        }
        return $this->vouchers;
    }
}
