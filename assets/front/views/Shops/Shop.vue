<template>
  <div v-if="$store.getters.typePage === 'Shops-Shop'">
    <bread-crumbs/>
    <div class="deals bg padTB60">
      <div class="container">
        <button-details/>
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="row" v-if="offersActual.length > 0">
              <div class="col-md-12 box1 marB30">
                <div class="section-box section-box-white">
                  <div class="boxbg">
                    <div class="row equal-row">
                      <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <font-awesome-icon class="icon-h1" icon="shopping-cart" />
                      </div>
                      <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <h1 class="h4 marL10" v-text="model.subpage.seo.header"></h1>
                        <div class="ask-btn text-right">
                          <button @click="redirectEmpty" class="itg-btn cart-btn"><span>Przejdź do sklepu</span></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 box1 marB30">
                <shop-offers-list :offers="offersActual" @shopPopupOffer="shopPopupOffer"/>
              </div>
            </div>
            <div class="row" v-else>
              <div class="col-md-12 box1 marB30">
                <div class="section-box section-box-white">
                  <div class="boxbg">
                    <h1 class="h4 description-text" v-text="model.subpage.subpage.content.data.description"></h1>
                    <div class="ask-btn text-right">
                      <button @click="redirectEmpty" class="itg-btn cart-btn"><span>Przejdź do sklepu</span></button>
                    </div>
                    <div class="h4">
                      <i class="flaticon-label"></i>Niestety, nie posiadamy w tej chwili żadnych promocji
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 box1 marB30 marT10" v-if="offersNotActual.length > 0">
                <div class="h4"><i class="flaticon-label"></i>
                  <span class="hidden-xs hidden-sm">Nieaktualne promocje</span>
                  <a href="#" @click.prevent="showNotActualOffers" class="hidden-md hidden-lg pointer">Pokaż nieaktualne promocje</a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <shop-offers-grid id="offers-not-actual" class="lazy-hidden-xs lazy-hidden-sm" :offers="offersNotActual" v-if="offersNotActual.length > 0" @shopPopupOffer="shopPopupOffer"/>
                </div>
              </div>
            </div>
            <div class="row" v-if="isContent">
              <div class="col-md-12 col-sm-12 col-xs-12 lazy-hidden-xs">
                <div v-html="model.subpage.content.content"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <opinions-comments v-if="model.subpage.opinions.length > 0"/>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 box1 marB30 marT10">
                <div class="ask-btn btn-fixed button-center hidden-lg hidden-md hidden-sm button-details ">
                  <button @click="redirectMainButton" class="itg-btn cart-btn btn-red">Przejdź do sklepu</button>
                </div>
              </div>
              <div class="col-md-4 box1 marB30 marT10">
                <div class="ask-btn btn-fixed hidden-lg hidden-md hidden-sm button-details ">
                  <button @click="showDetailsShop" class="itg-btn cart-btn">
                    <font-awesome-icon :icon="isPopupDetailShop ? 'arrow-right' : 'arrow-left'"/>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4 col-xs-12 lazy-hidden-xs" id="shop-details">
            <div class="row">
              <shop-details :shop="model"/>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- //***Deals-List End***// -->
    <div class="clear"></div>
  </div>

</template>

<script>
import BreadCrumbs from "@/components/BreadCrumbs/BreadCrumbs";
import RatingShop from "@/components/Elements/Rating/RatingShop";
import ButtonDetails from "@/views/Shops/Shop/ButtonDetails";
import ShopOffersGrid from "~/views/Shops/Shop/ListingPromotions/ShopOffersGrid";
import ShopOffersList from "~/views/Shops/Shop/ListingPromotions/ShopOffersList";
import OpinionsComments from "@/views/Shops/Shop/OpinionsComments";
import ShopDetails from "./Shop/ShopDetails";

export default {
  name: "Shop",
  components: {
    ShopDetails,
    OpinionsComments, ShopOffersList, ShopOffersGrid, ButtonDetails, RatingShop, BreadCrumbs},
  data() {
    return {
      shopDetailsHeight: null,
      contactShow: false,
      isPopupDetailShop: false
    }
  },
  computed: {
    isContent() {
      return  Boolean(this.model.subpage.content.content);
    },

    offersActual()
    {
      let dateNow = new Date();
      return _.filter(this.offers, offer => {
        if (!offer.offer.datetimeTo)
          return true;
        if (offer.offer.datetimeTo) {
          let dateTo = new Date(offer.offer.datetimeTo);
          let dateFrom = new Date(offer.offer.datetimeFrom);
          return dateNow > dateFrom && dateNow < dateTo;
        } else {
          return true;
        }
      });
    },
    offersNotActual() {
      let dateNow = new Date();
      return _.filter(this.offers, offer => {
        if (offer.offer.datetimeTo) {
          let dateTo = new Date(offer.offer.datetimeTo);
          let dateFrom = new Date(offer.offer.datetimeFrom);
          return (dateNow < dateFrom) || (dateNow > dateTo);
        } else {
          return false;
        }

      });
    },
    offers() {
      return this.model.subpage.offersPromo;
    },
    model() {
      return this.$store.getters.model;
    },
  },
  methods: {
    redirectEmpty() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop',
        label: 'empty-shop-link',
        value: this.model.subpage.subpage.idSubpage
      });
      this.redirectInsideShop();
    },
    redirectMainButton() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop',
        label: 'button-main-link',
        value: this.model.subpage.subpage.idSubpage
      });
      this.redirectInsideShop();
    },
    redirectOutsideShop() {
      this.redirectOutside(this.$store.getters.redirectLinkShop(this.model.subpage.idShopAffil));
    },
    redirectInsideShop() {
      this.redirectInside(this.$store.getters.redirectLinkShop(this.model.subpage.idShopAffil));
    },
    findIndexOffer(idOffer) {
      return _.findIndex(this.offers, offer => {
        return offer.offer.idOffer === idOffer;
      })
    },
    shopPopupOffer(payload)
    {
      let index = this.findIndexOffer(payload.idOffer);
      this.$router.push({hash: this.$generateHash({shopOffer: this.offers[index].offer.idOffer}), params: {scroll: false}});

      this.popupShopOffer(index, payload.redirect);
    },
    showNotActualOffers()
    {
      $('#offers-not-actual').toggleClass('hidden-xs').toggleClass('hidden-sm');
    },
    showDetailsShop() {
      this.isPopupDetailShop = !this.isPopupDetailShop;
      if (this.isPopupDetailShop) {
        this.$store.commit('setPopup', {
          template: () => import("@/views/Shops/Shop/PopupShopDetails"),
          data: {
            shop: this.model,
            afterClose: () => {
              this.isPopupDetailShop = !this.isPopupDetailShop;
            }
          },
        })
      } else {
        this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
      }

    },
    popupShopOffer(index, withRedirect = false)
    {
      if(withRedirect)
      {
        setTimeout(() => {
          if(this.offers[index].offer.actual)
            this.redirectOutside(this.$store.getters.redirectLinkOffer(this.offers[index].offer.idOffer));
          else
            this.redirectOutside(this.$store.getters.redirectLinkShop(this.model.subpage.idShopAffil));
        },200);
      }
      this.$store.commit('setPopup', {
        template: () => import('@/views/Shops/Shop/ListingPromotions/Promotions/PopupPromotionShopOffer'),
        title: 'Przejdź do promocji',
        options:{
          blockedExit: true,
          actionAfterClose: (obj = {}) => {
            this.$router.push({hash: '', params: {scroll: false}});
          },
        },
        data:{
          index,
        }
      })
    },
  },
  mounted() {
    let buttonShopDetails = document.getElementById('open-button-shop-details')
    if (buttonShopDetails)
      this.shopDetailsHeight = buttonShopDetails.getBoundingClientRect().y;

    setTimeout(() => {
      let hash = this.$parseHash();
      if(hash && hash.shopOffer && !isNaN(hash.shopOffer))
      {
        this.popupShopOffer(this.findIndexOffer(hash.shopOffer));
      }

    }, 500)
  }
}
</script>

<style scoped>

.btn-fixed {
  position: fixed;
  z-index: 1500;
  bottom: 0;
  right: 0;
  margin-bottom: 0;
}

.icon-h1 {
  font-size: 30px;
  font-style: normal;
}

h1.description-text {
  text-transform: unset;
}

.button-center {
  left: 20%;
  width: 60%;
}

.btn-red {
  background-color: red;
  width: 100%;
}
</style>
