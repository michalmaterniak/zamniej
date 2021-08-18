<template>
  <div class="slide-1 home-slider">
    <div class="home text-center bg-size blur-up lazyloaded" data-v-1443f4de="" style="background-image: url('/page2/images/woman-after-shopping-sitting-on-sofa-with-new-apparel-beautiful-fashionable-girl-holds-red-modern-shoes-and-sits-on-sofa.webp'); background-size: cover; background-position: center center; display: block;">
      <div class="slider-contain">
        <button class="btn btn-solid" @click.prevent="start">Znajdź promocję dla siebie <i class="fa fa-arrow-down"></i> </button>
      </div>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
export default {
  name: "MainHomeSlider",
  components: {VueSlickCarousel},
  data() {
    return {

    }
  },
  methods:{
    start(e) {
      document.getElementById('start-desc').scrollIntoView({ behavior: 'smooth' });
    }
  }
}
</script>

<style scoped>

</style>
