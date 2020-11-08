<template>
<div v-if="$store.getters.typePage === 'Homepages-Homepage'">

  <!-- //***slider-section Start***// -->
  <div class="slider-section bg padB60">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
          <!-- nav -->
          <categories :show="true" :canHide="false"/>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
          <main-slider :offers="model.subpage.mainSlider" v-if="model.subpage.mainSlider"/>
        </div>
      </div>
    </div>
  </div>
  <!-- //***slider-section End***// -->
  <div class="clear"></div>

  <!-- //***latest-deals Start***// -->
  <promotions-grid :promotions="model.subpage.promotions" v-if="model.subpage.promotions"/>
  <div class="clear"></div>
  <!-- //***latest-deals End***// -->

  <!-- //***Offers-section Start***// -->
  <new-offers-carousel :vouchers="model.subpage.vouchers" v-if="model.subpage.vouchers"/>
  <div class="clear"></div>
  <!-- //***Offers-section End***// -->

<!--  &lt;!&ndash; //***coupons-section Start***// &ndash;&gt;-->
<!--  <slider-coupons/>-->
<!--  <div class="clear"></div>-->
<!--  &lt;!&ndash; //***coupons-section End***// &ndash;&gt;-->


  <!-- //***popular-stores Start***// -->
  <popular-stores :shops="model.subpage.shopsLatest"/>
  <div class="clear"></div>
  <!-- //***Offers-section End***// -->

  <!-- //***latest-blog Start***// -->
  <latest-blog :articles="model.subpage.blogLatest"/>
  <!-- //***latest-blog End***// -->
  <div class="clear"></div>
</div>
</template>

<script>
  import Slider from "@/components/Sliders/Slider";
  import Categories from "@/components/Menu/Categories/Categories";
  import MainSlider from "@/views/Homepages/Carousel/MainSlider/MainSlider";
  import PromotionsGrid from "@/views/Homepages/Sections/PromotionsGrid";
  import SliderCoupons from "@/views/Homepages/Sections/SliderCoupons";
  import PopularStores from "@/views/Homepages/Sections/PopularStores";
  import LatestBlog from "@/views/Homepages/Sections/LatestBlog";
  import NewOffersCarousel from "~/views/Homepages/Carousel/CarouselPromotions2/NewOffersCarousel";
  export default {
    components: {
      NewOffersCarousel,
      LatestBlog,
      PopularStores,
      SliderCoupons,
      PromotionsGrid,
      MainSlider,
      Categories,
      Slider
    },
    data(){
      return {
        activeSlide: 1
      }
    },
    computed:{
      model()
      {
        return this.$store.getters.model;
      }
    },
  }
</script>

<style>
.equal {
  display: flex;
  display: -webkit-flex;
  flex-wrap: wrap;
}
</style>
