<template>
  <div class="shop-box pointer">
    <div class="brand-img">
      <favorite-shop v-if="withRemove" :id-subpage="shop.id" :remove="true"/>
      <figure @click="goToShop(shop)">
        <img :alt="shop.logo.original.data.alt" :src="shop.logo.modifyPath">
        <span v-text="shop.name"></span>
      </figure>
    </div>
  </div>
</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";
import FavoriteShop from "@/views/Shops/Shop/FavoriteShop";

export default {
  name: "TileShopSearch",
  components: {FavoriteShop, RatingShopShowing},
  props: {
    shop: {
      type: Object,
    },
    noLazy: {
      type: Boolean,
      default: true
    },
    withRemove: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    goToShop(shop) {
      this.$store.commit('setSearchKeyword', '');
      this.$store.commit('setSearchContainerOpen', false);
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
