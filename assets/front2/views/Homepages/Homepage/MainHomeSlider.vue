<template>
  <div class="slide-1 home-slider">
    <div>
      <div class="home  text-center">
        <img alt="" class="bg-img blur-up" src="/page2/images/woman-after-shopping-sitting-on-sofa-with-new-apparel-beautiful-fashionable-girl-holds-red-modern-shoes-and-sits-on-sofa.webp" data-not-lazy>
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="slider-contain">
                <div>
                  <a class="btn btn-solid" href="#" @click.prevent="start">Znajdź promocję dla siebie <i class="fa fa-arrow-down"></i> </a>
                </div>
              </div>
            </div>
          </div>
        </div>
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
