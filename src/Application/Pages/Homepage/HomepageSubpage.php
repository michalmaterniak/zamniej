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
     * @param string|null $name
     * @return
     */
    protected function getSliders(string $name = null)
    {
        if(!$this->sliders)
        {
            $this->sliders = new ArrayCollection();
            foreach ($this->getComponents()->getSliderRepository()->select()->getSlidersByNames([
                'homepage_sliders',
            ])->getResults() as $slider)
            {
                $this->sliders->set($slider->getName(), $slider);
            }
        }

        if($name)
            return $this->sliders->get($name);
        else
            return $this->sliders;

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
    public function getShopsLatest(int $max = 8)
    {
        if (!$this->shops) {
            $shops = $this->getComponents()->getResourcesManager()->loadShops(
                $this->getComponents()->getShopRepository()->select()->getLatest($max)->getResults()
            );
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
    public function getBlogLatest(int $max = 3)
    {
        if (!$this->blog) {
            $articles = $this->getComponents()->getResourcesManager()->loadBlogArticles(
                $this->getComponents()->getBlogArticleRepository()->select()->getLatest($max)->getResults()
            );
            $this->blog = new ArrayCollection();
            foreach ($articles as $article) {
                $this->blog->add([
                    'name' => $article->getSubpage()->getSubpage()->getName(),
                    'logo' => $article->getSubpage()->getPhoto()->getModifiedPhoto('adaptive', 360, 242),
                    'slug' => $article->getSubpage()->getSlug(),
                    'content' => $article->getSubpage()->getContent(),
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
                    'title' => $voucher->getOffer()->getTitle(),
                    'content' => $voucher->getOffer()->getContent()->getContent(),
                    'logo' => $voucher->getPhoto()->getModifiedPhoto('insertCenter', 292, 292),
                ]);
            }
        }
        return $this->vouchers;
    }

    /**
     * @return Slide[]|ArrayCollection
     * @Groups({"resource"})
     */
    public function getMainSlider()
    {
        if (!$this->mainSlider) {
            $this->mainSlider = new ArrayCollection();
            $this->sliders = $this->getComponents()->getSliderRepository()->indexByName()->mainSlider()->getResults();

            foreach ($this->sliders->get('homepage_sliders')->getSlides() as $slide) {
                $slideModel = $this->getComponents()->getSlide()->createSlide($slide);
                $this->mainSlider->add([
                    'header' => $slideModel->getSlide()->getHeader(),
                    'type' => $slideModel->getSlide()->getType(),
                    'idOffer' => $slideModel->getSlide()->getOffer()->getIdOffer(),
                    'photo' => $slideModel->getPhoto()->getModifiedPhoto('resize', 848, 290, []),
                ]);
            }
        }

        return $this->mainSlider;
    }

}
