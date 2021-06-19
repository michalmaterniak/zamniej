<template>
  <div class="row mb-5 p-3 border">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-3 align-center text-center">
          <img class="img-tile" :src="shop.logo.modifyPath" :alt="shop.logo.original.data.alt">
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8">
          <h6 class="h4" v-text="shop.name"></h6>
          <p class="short-content" v-if="shop.description" v-html="shop.description"></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
          <p><strong>Ocena <span v-text="shop.name"></span> </strong></p>
          <rating :rating="shop.rating"/>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center">
          <nuxt-link :to="{path: shop.slug}" class="btn btn-solid"> Zobacz promocje <span class="lazy-hidden-xs " v-text="'z ' + shop.name"></span> </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Rating from '@/components/Rating/Rating';

export default {
  name: 'TileShop',
  components: {Rating},
  props:{
    shop: {
      type: Object,
    },
    noLazy:{
      type: Boolean,
      default: true
    }
  }
}
</script>

<style scoped>
.img-tile {
  width: 75%;
}
@media (max-width: 480px) {
  .img-tile {
    width: 50%;
  }
}
.short-content {
  position: relative;
  top: 25%
}
@media (max-width: 768px) {
  .short-content {
    position: relative;
    top: 0
  }
}
</style>
