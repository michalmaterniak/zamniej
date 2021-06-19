<template>
  <div class="slide-7 no-arrow slick-instagram">
    <vue-slick-carousel v-bind="config">
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/2.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/3.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/4.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/9.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/6.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/7.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/8.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/9.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
      <div>
        <a href="#">
          <div class="instagram-box"><img alt="Avatar" class="bg-img"
                                          src="/page2/images/slider/2.jpg" style="width:100%">
            <div class="overlay"><i aria-hidden="true" class="fa fa-instagram"></i></div>
          </div>
        </a>
      </div>
    </vue-slick-carousel>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
export default {
  name: 'InstagramPosts',
  components: {VueSlickCarousel},
  data() {
    return {
      config: {
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 7,
        slidesToScroll: 7,
        responsive: [{
            breakpoint: 1367,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 6
            }
        },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
      }
    }
  }

}
</script>

<style scoped>

</style>
