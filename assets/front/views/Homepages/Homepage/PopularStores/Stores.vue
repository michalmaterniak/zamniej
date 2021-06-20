<template>
  <div class="offer-slider slide-1">
    <vue-slick-carousel v-bind="config">
      <div class="offer-slider slide-1"  v-for="(store, index) in stores">
        <div>
          <div class="media">
            <nuxt-link :to="store.slug">
              <img alt="" class="popular-store-img img-fluid blur-up lazyload" :src="store.logo.modifyPath">
            </nuxt-link>
          </div>
        </div>
      </div>
    </vue-slick-carousel>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'

export default {
  name: 'Stores',
  props: ['stores'],
  components: {VueSlickCarousel},
  data() {
    return {
      config: {
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
      }
    }
  },
}
</script>

<style scoped>
img.popular-store-img {
  width: 224px;
  height: 122px;
}
</style>
