<template>
  <div v-if="$store.getters.typePage === 'Homepages-Homepage'">
    <!-- Home slider -->
    <section class="p-0">
      <main-home-slider></main-home-slider>
    </section>
    <!-- Home slider end -->

    <!-- Paragraph-->
    <div class="title1 section-t-space" id="start-desc">
      <h1 class="h4 title-inner1" v-text="model.subpage.seo.header"></h1>
      <h4>Najpopularniejsze sklepy</h4>
    </div>
    <!-- Paragraph end -->

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

<!--    &lt;!&ndash; Parallax banner &ndash;&gt;-->
<!--    <section class="p-0">-->
<!--      <div class="full-banner parallax text-center p-left">-->
<!--        <img alt="" class="bg-img blur-up lazyload" src="/page2/images/parallax/1.jpg">-->
<!--      </div>-->
<!--    </section>-->
<!--    &lt;!&ndash; Parallax banner end &ndash;&gt;-->

<!--    &lt;!&ndash; Parallax banner &ndash;&gt;-->
<!--    <section class="p-0">-->
<!--      <div class="full-banner parallax text-center p-left">-->
<!--        <img alt="" class="bg-img blur-up lazyload" src="/page2/images/parallax/shopping-mall-1316787_1920.jpg">-->
<!--      </div>-->
<!--    </section>-->
<!--    &lt;!&ndash; Parallax banner end &ndash;&gt;-->

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

<!--    &lt;!&ndash; instagram section &ndash;&gt;-->
<!--    <section class="instagram ratio_square">-->
<!--      <div class="container-fluid">-->
<!--        <div class="row">-->
<!--          <div class="col-md-12 p-0">-->
<!--            <h2 class="title-borderless"># instagram</h2>-->
<!--            <instagram-posts/>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </section>-->
<!--    &lt;!&ndash; instagram section end &ndash;&gt;-->


<!--    &lt;!&ndash;  logo section &ndash;&gt;-->
<!--    <section class="section-b-space">-->
<!--      <div class="container">-->
<!--        <div class="row">-->
<!--          <div class="col-md-12">-->

<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </section>-->
<!--    &lt;!&ndash;  logo section end&ndash;&gt;-->


    <!-- footer -->

    <!-- footer end -->

    <!-- Quick-view modal popup start-->
<!--    <div id="quick-view" aria-hidden="true" class="modal fade bd-example-modal-lg theme-modal" role="dialog"-->
<!--         tabindex="-1">-->
<!--      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--        <div class="modal-content quick-view-modal">-->
<!--          <div class="modal-body">-->
<!--            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span-->
<!--              aria-hidden="true">&times;</span></button>-->
<!--            <div class="row">-->
<!--              <div class="col-lg-6 col-xs-12">-->
<!--                <div class="quick-view-img"><img alt="" class="img-fluid blur-up lazyload"-->
<!--                                                 src="/page2/images/pro3/1.jpg"></div>-->
<!--              </div>-->
<!--              <div class="col-lg-6 rtl-text">-->
<!--                <div class="product-right">-->
<!--                  <h2>Women Pink Shirt</h2>-->
<!--                  <h3>$32.96</h3>-->
<!--                  <ul class="color-variant">-->
<!--                    <li class="bg-light0"></li>-->
<!--                    <li class="bg-light1"></li>-->
<!--                    <li class="bg-light2"></li>-->
<!--                  </ul>-->
<!--                  <div class="border-product">-->
<!--                    <h6 class="product-title">product details</h6>-->
<!--                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium-->
<!--                      doloremque laudantium</p>-->
<!--                  </div>-->
<!--                  <div class="product-description border-product">-->
<!--                    <div class="size-box">-->
<!--                      <ul>-->
<!--                        <li class="active"><a href="#">s</a></li>-->
<!--                        <li><a href="#">m</a></li>-->
<!--                        <li><a href="#">l</a></li>-->
<!--                        <li><a href="#">xl</a></li>-->
<!--                      </ul>-->
<!--                    </div>-->
<!--                    <h6 class="product-title">quantity</h6>-->
<!--                    <div class="qty-box">-->
<!--                      <div class="input-group"><span class="input-group-prepend"><button-->
<!--                        class="btn quantity-left-minus"-->
<!--                        data-field="" data-type="minus" type="button"><i-->
<!--                        class="ti-angle-left"></i></button> </span>-->
<!--                        <input class="form-control input-number" name="quantity" type="text"-->
<!--                               value="1"> <span class="input-group-prepend"><button-->
<!--                          class="btn quantity-right-plus"-->
<!--                          data-field="" data-type="plus" type="button"><i-->
<!--                          class="ti-angle-right"></i></button></span></div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div class="product-buttons"><a class="btn btn-solid" href="#">add to cart</a> <a-->
<!--                    class="btn btn-solid" href="#">view detail</a></div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
    <!-- Quick-view modal popup end-->

    <!-- exit modal popup start-->
<!--    <div id="exit_popup" aria-hidden="true" class="modal fade bd-example-modal-lg theme-modal exit-modal" role="dialog"-->
<!--         tabindex="-1">-->
<!--      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--        <div class="modal-content">-->
<!--          <div class="modal-body modal1">-->
<!--            <div class="container-fluid p-0">-->
<!--              <div class="row">-->
<!--                <div class="col-12">-->
<!--                  <div class="modal-bg">-->
<!--                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">-->
<!--                      <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                    <div class="media">-->
<!--                      <img alt=""-->
<!--                           class="stop img-fluid blur-up lazyload mr-3" src="/page2/images/stop.png">-->
<!--                      <div class="media-body text-left align-self-center">-->
<!--                        <div>-->
<!--                          <h2>wait!</h2>-->
<!--                          <h4>We want to give you-->
<!--                            <b>10% discount</b>-->
<!--                            <span>for your first order</span>-->
<!--                          </h4>-->
<!--                          <h5>Use discount code at checkout</h5>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
    <!-- Add to cart modal popup end-->

    <!--  &lt;!&ndash; cart start &ndash;&gt;-->
    <!--  <div id="fixed_cart_icon" class="addcart_btm_popup">-->
    <!--    <a class="fixed_cart" href="#">-->
    <!--      <i class="ti-shopping-cart"></i>-->
    <!--    </a>-->
    <!--  </div>-->
    <!--  &lt;!&ndash; cart end &ndash;&gt;-->


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
