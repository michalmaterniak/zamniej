<template>
  <div v-if="offers.length > 0">
    <client-only>
      <vue-glide v-model="activeSlide"
                 :type="'slider'"
                 :perView="1"
      >

        <vue-glide-slide v-for="(offer, index) in offers" :key="index">
          <div class="item">
            <figure>
              <img class="img-slider" :src="offer.photo.modifyPath" :alt="offer.header" data-not-lazy>
              <div class="box-slider">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h4 v-text="offer.header"></h4>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="text-left">
                        <!--                  <rating v-if="0" :rating="slide.rating.rating" :count="slide.rating.count"/>-->
                        <!--                  <h5 >Ważny przez: <span class="red" ></span></h5>-->
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="text-right">
                        <!--                  <button class="itg-btn box-btn white" >{{ offer.slide.extra.code }}<span></span></button>-->
                        <button @click.prevent="redirect(offer.idOffer)"
                                class="itg-btn white btn  btn-orange btn-promo" v-if="offer.type === 2">Pobierz
                          kupon
                        </button>
                        <button @click.prevent="redirect(offer.idOffer)"
                                class="itg-btn white btn  btn-orange btn-promo" v-else>Przejdź do promocji
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </figure>
          </div>

        </vue-glide-slide>
      </vue-glide>
    </client-only>
      <div class="owl-nav">
        <div class="owl-prev pointer"  @click="changeSlide(-1)">
          <font-awesome-icon icon="arrow-left" />
        </div>
        <div class="owl-next pointer" @click="changeSlide(1)">
          <font-awesome-icon icon="arrow-right" />
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: "MainSlider",
  props:{
    offers:{
      type:Array,
      default: []
    }
  },
  data()
  {
    return {
      activeSlide: 0,
      interval: null
    }
  },
  watch:{
    activeSlide(prev, next)
    {
      this.resetInterval();
    }
  },
  methods: {
    redirect(idOffer) {
      this.$gtagEv({
        action: 'redirect',
        category: 'offer',
        label: 'main-slider',
        value: idOffer
      });
      this.redirectOffer(idOffer)
    },
    changeSlide(i = 1) {
      if (this.activeSlide + i >= this.offers.length)
        this.activeSlide = 0;
      else if (this.activeSlide + i < 0)
        this.activeSlide = this.offers.length - 1;
      else
        this.activeSlide = this.activeSlide + i;
    },
    resetInterval()
    {
      if(this.interval)
        clearInterval(this.interval);
      this.interval = setInterval(this.changeSlide, 5000);
    }
  },
  mounted() {
    this.resetInterval();
  }
}
</script>

<style scoped>

</style>
