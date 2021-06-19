<template>
  <div class="shop-box">
    <div class="deals">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 ">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <figure>
                <img :src="shop.logo.modifyPath" :alt="shop.logo.original.data.alt">
              </figure>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
              <h2 class="h4 bold hover marB20" v-text="shop.name"></h2>
            </div>
          </div>

          <div class="row marB30">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
              <p><strong>Ocena <span v-text="shop.name"></span> </strong></p>
              <rating-shop-showing :rating="shop.rating" />
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center text-box">
              <div class="text-p" v-if="shop.description" v-html="shop.description"></div>
              <div class="text-p" v-else >Lorem Ipsum is simply dummy text of the printing and typesetting industry.<span class="hidden-sm"> Lorem  Ipsum has been the industry's standard dummy text ever since</span></div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sm-b text-center">
              <div class="ask-btn">
                <h3>
                  <nuxt-link :to="{path: shop.slug}" class="btn itg-btn cart-btn"> Zobacz promocje <span class="lazy-hidden-xs " v-text="'z ' + shop.name"></span> </nuxt-link>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";
export default {
  name: "TileShopAll",
  components: {RatingShopShowing},
  props:{
    shop: {
      type: Object,
    },
    noLazy:{
      type: Boolean,
      default: true
    }
  }
}
</script>

<style scoped>

.itg-btn.cart-btn
{
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
}
</style>
