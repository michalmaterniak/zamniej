<template>
  <div class="col-md-12 col-sm-12 col-xs-12" @click="goToShop">
    <div class="box-a">
      <figure>
        <img :src="offer.logo.modifyPath" :alt="offer.logo.original.data.alt">
      </figure>
      <div class="box-detail box-detail-white-back">
        <h4 class="hover marB5" v-text="offer.title"></h4>
        <div class="content-promo" v-html="offer.content"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GridPromotions",
  props:['offer'],
  methods: {
    goToShop() {
      window.open(this.getShopPageWithShopOfferHash(this.offer.slug, this.offer.idOffer));
      location.href = this.$store.getters.redirectLinkOffer(this.offer.idOffer)
    }
  }
}
</script>

<style scoped>

</style>
