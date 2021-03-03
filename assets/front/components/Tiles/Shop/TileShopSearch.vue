<template>
  <div class="shop-box pointer">
    <div class="brand-img">
      <figure @click="goToShop(shop)">
        <img :alt="shop.logo.original.data.alt" :src="shop.logo.modifyPath">
        <nuxt-link :to="shop.slug"></nuxt-link>
      </figure>
    </div>
  </div>
</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";

export default {
  name: "TileShopSearch",
  components: {RatingShopShowing},
  props: {
    shop: {
      type: Object,
    },
    noLazy: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    goToShop(shop) {
      this.$store.commit('setSearchKeyword', '');
      this.$router.push({path: shop.slug})
    }
  }
}
</script>

<style scoped>

.itg-btn.cart-btn {
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
}

figure > h5 {
  font-family: Flaticon;
}
</style>
