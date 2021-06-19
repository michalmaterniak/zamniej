<template>
  <div class="modal-content" id="main-modal" style="height: 85%" >
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-html="title + ' ' + '<strong>'+offer.offer.title+'</strong>'"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <content-promotion-offer :offer="offer" />
    </div>
    <div class="modal-footer">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" v-if="offer.offer.actual">
          <liking-offer :offer="offer" @setNewLiking="offerShopLiking"/>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <button class="itg-btn cart-btn" @click.prevent="redirectToShop">
            <span class="hidden-md hidden-lg">Przejdź</span>
            <span class="hidden-xs hidden-sm" ><span v-if="offer.offer.actuall">Przejdź do promocji</span><span v-else>Przejdź do sklepu</span></span>
          </button>
<!--          <button class="itg-btn cart-btn cart-btn-reverse" @click="closePopup">Zamknij</button>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import CodeClipboard from "@/components/Popup/Components/CodeClipboard";
import LikingOffer from "~/components/Liking/LikingOffer";
import liking from "@/mixins/Liking/liking";
import ContentPromotionOffer from "@/components/Popup/Components/ContentPromotionOffer";
export default {
  components: {ContentPromotionOffer, LikingOffer, CodeClipboard},
  props: ['title', 'data', 'options'],
  name: "PopupPromotionShopOffer",
  mixins:[liking],
  data(){
    return {
      responseLiking: null
    }
  },
  computed:{
    offer()
    {
      return this.$store.getters.model.subpage.offersPromo[this.data.index];
    }
  },
  methods: {
    redirectToShop()
    {
      if(this.offer.offer.actual)
        this.redirectOffer(this.offer.offer.idOffer);
      else
        this.redirectShop(this.offer.idShop);
    },
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    },
  },
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
.mini-thumb
{
  width: 50%;
  height: auto;
}

</style>

