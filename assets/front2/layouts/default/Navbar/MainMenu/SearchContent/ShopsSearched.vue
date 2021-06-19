<template>
  <div class="row shops-searched">

    <div class="row mt-5 product-tab">
      <div class="col-xl-12 title1" v-if="isSearched || shops.length > 0">
        <h4>Znalezione sklepy</h4>
      </div>
      <div class="col-6 col-xs-4 col-sm-4 col-md-3 col-xl-2 tab-box" v-for="(shop, index) in shops" :key="index">
        <div class="product-box2" :style="{'display' : displayShops}">
          <nuxt-link :to="{path: shop.slug}">
            <div class="media">
              <img
                alt=""
                class="img-fluid blur-up lazyload"
                :src="shop.logo.modifyPath">
              <h6 v-text="shop.name" class="h6 text-center"></h6>
            </div>
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ShopsSearched',
  props: ['shops'],
  data() {
    return {
      isSearched: false
    }
  },
  watch: {
    shops() {
      if (this.shops.length > 0) {
        this.isSearched = true;
      }
    }
  },
  computed: {
    displayShops() {
      return this.shops.length === 0 ? 'none' : 'block';
    }
  },
  created() {

  }
}
</script>

<style scoped>
.tab-box {
  animation: zoomIn 300ms ease-in-out;
}
.main-menu .menu-right .icon-nav .mobile-search img {
  display: block;
}
</style>
