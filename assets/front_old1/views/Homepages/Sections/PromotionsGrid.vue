<template>
  <div class="latest-deals bg">
    <div class="container padB60 ">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 box1">
          <div class="section-box">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="boxbg">
                <h3><a href="#"><i class="flaticon-label"></i></a> Promocje</h3>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="symbol">
                <h5><nuxt-link :to="{path: '/promocje'}">zobacz więcej <i class="flaticon-external-link-symbol"></i></nuxt-link></h5>
              </div>
            </div>
          </div>
        </div>
        <div class="masonry masonry-columns-4">
          <div @click="redirect(offer)" class="masonry-item" v-for="(offer, index) in promotions">
            <div class="box-a white-gradient">
              <figure>
                <img :src="offer.logo.modifyPath" :alt="offer.logo.original.data.alt">
              </figure>
              <div class="box-detail box-detail-white-back">
                <h4 class="hover marB5" v-text="offer.title"></h4>
                <h5 class="h4" v-text="offer.shop"></h5>
                <button class="btn btn-orange">Przejdź do promocji</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";

export default {
  name: "PromotionsGrid",
  components: {RatingShopShowing},
  props: ['promotions'],
  methods: {
    redirect(offer) {
      this.openPopupPromo(offer.idOffer, true, {
        action: 'redirect',
        category: 'offer',
        label: 'promotions'
      })
    }
  }
}
</script>

<style scoped>
.btn-orange {
  color: #fff;
  background-color: #f57f25;
  border-color: #f57f25;
  width: 100%;
}

.btn-orange:hover {
  color: #212529;
  background-color: #eee;
  border-color: #f57f25;
}
.white-gradient {
  background: rgba(255,255,255,0);
  background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(246,246,246,1) 50%, rgba(255,255,255,1) 100%);
  background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0)), color-stop(50%, rgba(246,246,246,1)), color-stop(100%, rgba(255,255,255,1)));
  background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(246,246,246,1) 50%, rgba(255,255,255,1) 100%);
  background: -o-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(246,246,246,1) 50%, rgba(255,255,255,1) 100%);
  background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(246,246,246,1) 50%, rgba(255,255,255,1) 100%);
  background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(246,246,246,1) 50%, rgba(255,255,255,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#ffffff', GradientType=0 );

}
</style>
