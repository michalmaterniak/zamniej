<template>
  <div class="shop-box pointer" @click="$emit('toPath', shop.slug)">
    <div class="brand-img">
      <figure>
        <img :alt="shop.logo.original.data.alt" :src="shop.logo.modifyPath">
        <h5 v-text="shop.name"></h5>
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
