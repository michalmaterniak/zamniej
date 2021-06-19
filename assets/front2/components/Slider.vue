<template>
  <div>
    <VueSlickCarousel :arrows="true" :dots="true">
      <div>1</div>
      <div>2</div>
      <div>3</div>
      <div>4</div>
    </VueSlickCarousel>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
// import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// // optional style for arrows & dots
// import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
  name: "Slider",

  components: { VueSlickCarousel },

  data() {
    return {
      slickOptions: {
        slidesToShow: 3,
      },
    };
  },

  // All slick methods can be used too, example here
  methods: {

  },
}
</script>

<style scoped>

</style>
