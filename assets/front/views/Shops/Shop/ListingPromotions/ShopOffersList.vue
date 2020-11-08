<template>
  <div>
    <div v-for="(offer, index) in offers" :key="index">
      <promotion-list :offer="offer" :index="index+1" :max="offers.length" @shopPopupOffer="shopPopupOffer"/>
    </div>
  </div>
</template>

<script>
import PromotionList from "~/views/Shops/Shop/ListingPromotions/Promotions/PromotionList";
export default {
  name: "ShopOffersList",
  components: {PromotionList},
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
