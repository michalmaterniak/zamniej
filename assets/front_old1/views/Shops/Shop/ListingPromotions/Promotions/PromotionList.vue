<template>
  <client-only>

  <div class="col-md-12 col-sm-12 col-xs-12 marT30 marB30 promo-box" :class="{'promo-no-loger-current' : !offer.offer.actual}">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 box-l">
        <div class="box-detail boxs res-width">
          <div class="col-md-12 col-sm-12 col-xs-12 sm-b">
            <div class="row">
              <div class="col-md-10 text-left">
                <h4 class="hover marB20 bold" v-text="offer.offer.title"></h4>
              </div>
            </div>
            <div class="row">
              <h4 class="h4"> Oferta ważna do
                <strong v-text="showDate(offer.offer.datetimeTo)"></strong>
              </h4>
              <div class="content-promo" v-html="offer.offer.content.content"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="offer.offer.actual">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <liking-offer :offer="offer" @setNewLiking="offerShopLiking"/>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="offer.offer.actual">
        <div class="box-detail text-right">
          <div class="ask-btn">
            <button class="itg-btn cart-btn" @click.prevent="$emit('shopPopupOffer', {idOffer: offer.offer.idOffer, redirect: true})"> <span v-if="offer.offer.code" >Pobierz kupon rabatowy</span><span v-else>Przejdz do promocji</span> </button>
          </div>
        </div>
      </div>
    </div>

  </div>
  </client-only>
</template>

<script>
import LikingOffer from "~/components/Liking/LikingOffer";
import liking from "@/mixins/Liking/liking";
export default {
  name: "PromotionList",
  components: {LikingOffer},
  props:['offer', 'index', 'max'],
  mixins:[liking],
  methods:{
    showDate(date)
    {
      if(date)
        return this.$moment(date).format('LL');
      else
        return 'odwolania';
    },
  },
}
</script>

<style scoped>
.col-height
{
  height: 300px;
}

.btn-orange {
  color: #fff;
  background-color: #f57f25;
  border-color: #eee
}

.btn-orange:hover {
  color: #fff;
  background-color: #f57f25;
  border-color: #f57f25
}


.cart-btn
{
  border-radius: 15px;
}
.cart-btn:hover
{
  background-color: black;
}
.rotate30
{
  position: absolute;
  left: 200px;
  top: 30px;
  transform: rotate(30deg);
  opacity: 0.4;
}

</style>
