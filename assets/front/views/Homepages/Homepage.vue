<template>
  <div v-if="$store.getters.typePage === 'Homepages-Homepage'">
    <!-- Home slider -->
    <section class="p-0">
      <main-home-slider />
    </section>
    <!-- Home slider end -->

    <!-- Paragraph-->
    <div class="title1 section-t-space" id="start-desc">
      <h1 class="h4 title-inner1" v-text="model.subpage.seo.header"></h1>
      <h4>Najpopularniejsze sklepy</h4>
    </div>
    <!-- Paragraph end -->

    <client-only>
      <!-- Product slider -->
      <section class="section-b-space p-t-0 ratio_asos">
        <div class="container">
          <div class="row">
            <div class="col">
              <popular-stores :stores="popularShops"/>
            </div>
          </div>
        </div>
      </section>
      <!-- Product slider end -->
    </client-only>

    <!-- Parallax banner -->
    <section class="p-0">
      <div class="full-banner parallax text-center p-left">
        <img alt="" class="bg-img blur-up lazyload" src="/page2/images/parallax/1.webp" data-not-lazy>
      </div>
    </section>
    <!-- Parallax banner end -->

    <!-- Tab product -->
    <div class="title1 section-t-space">
      <h2 class="h4 title-inner1">Najpopularniejsze promocje i najnowsze kupony rabatowe</h2>
    </div>
    <section class="section-b-space p-t-0 ratio_asos">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <read-more-content
              v-if="model.subpage.content.content && model.subpage.content.data.lead"
              :content="model.subpage.content.content"
              :lead="model.subpage.content.data.lead"
            />
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <special-offers
              :promotions="{0: model.subpage.promotions, 1: model.subpage.vouchers}"
            />
          </div>
        </div>
      </div>

    </section>
    <!-- Tab product end -->

    <!-- blog section -->
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="title1 section-t-space">
            <h4>blog</h4>
            <h2 class="h4 title-inner1">co słychać na blogu?</h2>
          </div>
        </div>
      </div>
    </div>
    <section class="collection section-b-space ratio_square ">
      <div class="container">
        <blog-posts :articles="model.subpage.blogLatest"></blog-posts>
      </div>
    </section>
    <!-- blog section end -->

    <!-- tap to top -->
    <div class="tap-top top-cls">
      <div>
        <i class="fa fa-angle-double-up"></i>
      </div>
    </div>
    <!-- tap to top end -->

  </div>
</template>

<script>
import MainHomeSlider from "~/views/Homepages/Homepage/MainHomeSlider";
import PopularStores from "~/views/Homepages/Homepage/PopularStores";
import BlogPosts from "@/views/Homepages/Homepage/BlogPosts";
import InstagramPosts from "@/views/Homepages/Homepage/InstagramPosts";
import Navbar from "@/layouts/default/Navbar";
import TopHeader from "@/layouts/default/Navbar/TopHeader";
import SpecialOffers from "@/views/Homepages/Homepage/SpecialOffers";
import ReadMoreContent from "@/views/Homepages/Homepage/ReadMoreContent";

export default {
  components: {
    ReadMoreContent,
    SpecialOffers, TopHeader, Navbar, InstagramPosts, BlogPosts, PopularStores, MainHomeSlider},
  data(){
    return {
      activeSlide: 1
    }
  },
  computed:{
    model()
    {
      return this.$store.getters.model;
    },
    popularShops() {
      return this.model.subpage.shopsPopular;
    }
  }
}
</script>

<style>

</style>
