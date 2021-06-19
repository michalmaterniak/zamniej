<template>
  <div @click="redirect" class="col-md-12 col-sm-12 col-xs-12">
    <div class="box-a">
      <img class="img-50-p" :src="offer.logo.modifyPath" :alt="offer.logo.original.data.alt">

      <div class="box-detail box-detail-white-back">
        <h4 class="h6" v-text="offer.title"></h4>
        <h6 v-text="$stripTags(offer.content)"></h6>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GridPromotions",
  props:['offer'],
  methods: {
    redirect() {
      this.$gtagEv({
        action: 'redirect',
        category: 'promotions',
        label: 'offer-' + String(this.offer.idOffer)
      });
      window.open(this.getShopPageWithShopOfferHash(this.offer.slug, this.offer.idOffer));
      location.href = this.$store.getters.redirectLinkOffer(this.offer.idOffer)
    }
  }
}
</script>

<style scoped>
.img-50-p {
  width: 75% !important;
  height: 75% !important;
}
</style>
