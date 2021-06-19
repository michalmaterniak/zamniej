<template>
  <div class="slider-second slidernav padTB60" v-if="vouchers">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 marB30">
          <div class="section-box text-left">
            <h3><i class="flaticon-stars-couple-of-different-sizes"></i> Najnowsze promocje i kupony rabatowe</h3>
          </div>
        </div>
      </div>
    </div>
      <div class="container-fluid">
        <client-only>
          <VueSlickCarousel v-bind="settings" ref="carousel"  >
            <div class="slick-slide" v-for="(voucher, i) in vouchers" :key="'slider1' + i">
              <div class="inner">
                <slider-promotion :offer="voucher" :index="i" :key="'slide-' + i"/>
              </div>
            </div>
          </VueSlickCarousel>
        </client-only>
      </div>
  </div>
</template>

<script>
import SliderPromotion from "~/views/Homepages/Carousel/CarouselPromotions/SliderPromotion";

import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
  name: "NewOffersCarousel",
  components: {SliderPromotion, VueSlickCarousel},
  props: ['vouchers'],
  data() {
    return{
      speed: 5000,
      settings: {
        "arrows": false,
        "dots": false,
        "infinite": true,
        "slidesToShow": 5,
        "slidesToScroll": 1,
        "autoplay": true,
        "speed": 5000,
        "autoplaySpeed": 1,
        initialSlide: 0,
        "cssEase": "linear",
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 1008,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }

        ]
      }
    }
  },
  methods:{

  },
  created() {
    this.settings.speed = this.speed;
  }
}
</script>

<style scoped>
  h1 {
    text-align: center;
    margin: 40px 0;
    font-size: 40px;
    font-family: sans-serif;
    text-transform: uppercase;
    font-weight: bold;
  }
  .slick-slide .inner {
    margin: 0 15px;
  }
</style>
