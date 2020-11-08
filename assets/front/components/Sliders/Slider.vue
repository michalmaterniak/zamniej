<template>
  <div id="slider" class="owl-carousel owlCarousel">
    <div class="item " v-for="(offer, index) in offers" :key="index">
      <figure>
        <img class="img-slider" :src="offer.photo.modify" :alt="offer.photo.original.alt" data-not-lazy>
        <figcaption>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <h4 v-text="offer.slide.header"></h4>
            <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="text-left">
<!--                  <rating-shop v-if="0" :rating="slide.rating.rating" :count="slide.rating.count"/>-->
<!--                  <h5 >Ważny przez: <span class="red" ></span></h5>-->
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="text-right">
<!--                  <button class="itg-btn box-btn white" >{{ offer.slide.extra.code }}<span></span></button>-->
                  <button class="itg-btn white btn  btn-orange btn-promo" v-if="offer.slide.type === 2" @click="popupCode">Pobierz kupon</button>
                  <button class="itg-btn white btn  btn-orange btn-promo" v-else @click="redirect(offer.slide.link)">Sprawdź promocję</button>
                </div>
              </div>
            </div>
          </div>
        </figcaption>
      </figure>
    </div>
  </div>
</template>

<script>
import RatingShop from "@/components/Elements/Rating/RatingShop";
export default {
  name: "Slider",
  components: {RatingShop},
  props:{
    offers:{
      type: Array,
      default: []
    }
  },
  data(){
    return {
      active: 1,
      timeout: 5000,
    }
  },
  methods:{
    redirect(link)
    {
      window.setValue = this.setValue;
      window.open(document.location);
      document.location.href = link;
    },
    popupCode()
    {
      this.$store.commit('setPopup', {
        title: 'kod rabatowy',
        template: () => import("@/components/Popup/PopupShowCode"),
        data: {

        }
      })
    }
  },
  mounted() {
    $('#slider').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      autoplay: true,
      navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    });
  },
}
</script>

<style>

.btn-orange {
  color: #212529;
  background-color: #eee;
  border-color: #f57f25
}

.btn-orange:hover {
  color: #fff;
  background-color: #f57f25;
  border-color: #f57f25
}

.btn-promo{
  text-transform: uppercase;
  font-weight: bold;
  font-size: 14px;
  color: #000;
}
</style>
