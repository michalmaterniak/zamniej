<template>
  <div>
    <div class="col-md-4 col-sm-6 col-xs-12 col" v-for="(offer, index) in offers" :key="index">
      <promotion-grid :offer="offer" @shopPopupOffer="shopPopupOffer"/>
    </div>
  </div>
</template>

<script>
import PromotionGrid from "~/views/Shops/Shop/ListingPromotions/Promotions/PromotionGrid";
export default {
  name: "ShopOffersGrid",
  components: {PromotionGrid},
  props:['offers'],
  methods:{
    shopPopupOffer(payload)
    {
      this.$emit('shopPopupOffer', payload);
    }
  },
  computed:{
    model()
    {
      return this.$store.getters.model;
    }
  }
}
</script>

<style scoped>

.orange-bg{
  color: #fff;
}
</style>
