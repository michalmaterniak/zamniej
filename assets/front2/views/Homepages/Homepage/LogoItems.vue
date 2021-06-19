<template>
  <div class="slide-6 no-arrow">
    <vue-slick-carousel>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/1.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/2.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/3.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/4.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/5.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/6.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/7.png"></a>
        </div>
      </div>
      <div>
        <div class="logo-block">
          <a href="#"><img alt="" src="/page2/images/logos/8.png"></a>
        </div>
      </div>
    </vue-slick-carousel>
  </div>
</template>

<script>
import VueSlickCarousel from "vue-slick-carousel";

export default {
  name: 'LogoItems',
  components: {VueSlickCarousel},
  data() {
    return {
      config: {
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [{
          breakpoint: 1367,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
            infinite: true
          }
        },
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
      }
    }
  }
}
</script>

<style scoped>

</style>
