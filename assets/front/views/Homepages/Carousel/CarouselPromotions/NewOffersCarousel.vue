<template>
  <div class="slider-second slidernav padTB60">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 marB30">
          <div class="section-box text-left">
            <h3><i class="flaticon-stars-couple-of-different-sizes"></i> Najnowsze promocje i kupony rabatowe</h3>
          </div>
        </div>
      </div>
    </div>
    <client-only>
      <div class="container-fluid">
        <div class="row">
          <vue-glide
            :type="'carousel'"
            :autoplay="true"
            :animationDuration="6000"
            :animationTimingFunc="'linear'"
            :per-view="6"
            :breakpoints="{

            532: {
              perView: 2,
              animationDuration: 7000
            },
            1200: {
              perView: 3,
              animationDuration: 9000
            },
          }"
            :bound="true"
          >
            <vue-glide-slide v-for="i in 20" :key="i">
              <slider-promotion :i="i"/>
            </vue-glide-slide>
          </vue-glide>

        </div>
      </div>

    </client-only>
  </div>
</template>

<script>
import SliderPromotion from "~/views/Homepages/Carousel/CarouselPromotions/SliderPromotion";
export default {
  name: "NewOffersCarousel",
  components: {SliderPromotion}
}
</script>

<style scoped>

</style>
