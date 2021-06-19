<template>
  <div class="container">
    <div class="row mt-5 product-tab" v-if="favoriteShops.length > 0">
      <div class="col-xl-12 title1">
        <h4>Polubione sklepy</h4>
      </div>
      <div class="col-6 col-xs-4 col-sm-4 col-md-3 col-xl-2 tab-box" v-for="(shop, index) in favoriteShops" :key="index">
        <div class="product-box2">
          <nuxt-link :to="shop.slug">
            <div class="media">
              <img
                alt=""
                class="img-fluid blur-up lazyload"
                :src="shop.logo.modifyPath">
              <h6 v-text="shop.name" class="h6 text-center shop-name"></h6>
            </div>
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: 'ShopsFavorite',

  computed:{
    ...mapGetters([
      'favoriteShops',
    ]),
    isFavorites() {
      return this.favoriteShops.length > 0
    },
  },

}
</script>

<style scoped>
h6.shop-name {
  text-decoration: underline;
}
h6.shop-name:hover {
  text-decoration: none;
}
.main-menu .menu-right .icon-nav .mobile-search img {
  display: block;
}
</style>
