<template>
  <div class="modal-content" id="main-modal2" style="height: 85%" v-if="offer">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-html="title + ' ' + '<strong>'+offer.offer.title+'</strong>'"></h5>
      <button type="button" class="close btn" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body ">
      <div class="row" v-if="offer.offer.actual">
        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 text-right">
          <code-clipboard v-if="offer.typeOffer === 'voucher'" :code="offer.offer.data.code"/>
          <div v-else class="bold">Promocja nie wymaga kodu rabatowego!</div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" v-if="offer.offer.actual">
<!--          <liking-offer :offer="offer.offer.liking"/>-->
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <button class="btn btn-solid" @click.prevent="redirectToShop">
            <span class="d-md-none d-lg-none d-xl-none">Przejdź</span>
            <span class="d-none d-md-block d-lg-block d-xl-block" ><span v-if="offer.offer.actuall">Przejdź do promocji</span><span v-else>Przejdź do sklepu</span></span>
          </button>
<!--          <button class="itg-btn cart-btn cart-btn-reverse" @click="closePopup">Zamknij</button>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import CodeClipboard from "@/components/Popup/Components/CodeClipboard";
import LikingOffer from "~/components/Liking/Liking";
import liking from "@/mixins/Liking/liking";
import ContentPromotionOffer from "@/components/Popup/Components/ContentPromotionOffer";
export default {
  components: {ContentPromotionOffer, LikingOffer, CodeClipboard},
  props: ['title', 'data', 'options'],
  name: "PopupPromotionOffer",
  data(){
    return {
      responseLiking: null,
      offer: null,
      redirect: false,
    }
  },
  watch:{
    redirect(next, prev) {
      if(next === true) {
        this.redirectToShop();
      }
    }
  },
  mixins:[liking],
  methods: {
    redirectToShopTimeout(sec) {
      setTimeout(() => {
        this.redirectToShop(true);
      }, sec*1000);
    },
    redirectToShop(outside = false)
    {
      if(this.offer.offer.actual) {
        this.$gtagEv({
          action: 'redirect',
          category: 'popup',
          label: 'offer-' + String(this.offer.offer.idOffer)
        });
        if (outside) {
          this.redirectOfferOutside(this.offer.offer.idOffer)
        } else {
          this.redirectOffer(this.offer.offer.idOffer);
        }
      }
      else {
        this.$gtagEv({
          action: 'redirect',
          category: 'popup',
          label: 'shop-' + String(this.offer.idShop)
        });
        if (outside) {
          this.redirectOfferOutside(this.offer.offer.idOffer)
        } else {
          this.redirectShop(this.offer.idShop);
        }
      }
    },
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    },
  },
  created() {
    this.$axios.post('page/api/shops/offers/offer/' + this.data.idOffer).then(res => {
      this.offer = res.data.offer;
      setTimeout(() => {
        this.redirect = this.options.redirect;
      }, 400);
    })
  }
}
</script>

<style scoped>
.cart-btn
{
  border: #f57f25 solid;
}
.cart-btn:hover
{
  background-color: #fff;
  color: #000;
}
.cart-btn-reverse
{
  background-color: #fff;
  color: #000;
}
.cart-btn-reverse:hover
{
  background-color: #f57f25;
  color: #fff;
}
#main-modal2 {
  opacity: 1;
}


</style>

