<template>
  <!-- loader start -->
  <div class="loader_skeleton">
<!--    <top-header/>-->
    <header>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <main-menu :is-loader="true"/>
          </div>
        </div>
      </div>
    </header>
    <div class="home-slider">
      <div class="home"></div>
    </div>
    <section class="collection-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="ldr-bg">
              <div class="contain-banner">
                <div>
                  <h4></h4>
                  <h2></h2>
                  <h6></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="ldr-bg">
              <div class="contain-banner">
                <div>
                  <h4></h4>
                  <h2></h2>
                  <h6></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container section-b-space">
      <div class="row section-t-space">
        <div class="col-lg-6 offset-lg-3">
          <div class="product-para">
            <p class="first"></p>
            <p class="second"></p>
          </div>
        </div>
        <div class="col-12">
          <div class="no-slider row">
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
            <div class="product-box">
              <div class="img-wrapper"></div>
              <div class="product-detail">
                <h4></h4>
                <h5></h5>
                <h5 class="second"></h5>
                <h6></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- loader end -->
</template>

<script>
import TopHeader from "@/layouts/default/Navbar/TopHeader";
import MainMenu from "@/layouts/default/Navbar/MainMenu";
export default {
  name: "Loader",
  components: {MainMenu, TopHeader},
  data() {
    return {
      loader: null,
    }
  },
  watch:{
    isLoader(to) {
      if (to) {
        this.startLoader();
      } else {
        this.stopLoader();
      }
    }
  },
  computed:{
    isLoader() {
      return this.$store.getters.isLoader;
    }
  },
  methods:{
    startLoader() {
      this.loader.remove('slow');
      $('body').css({
        'overflow': 'auto'
      });
      $('.loader_skeleton').show();
    },
    stopLoader() {
      this.loader.remove('slow');
      $('body').css({
        'overflow': 'hidden'
      });

      this.loader.fadeOut('slow');
      $('body').css({
        'overflow': 'auto'
      });
      $('.loader_skeleton').hide('slow');
    }
  },
  mounted() {
    this.loader = $('.loader_skeleton');
    this.stopLoader();
  }
}
</script>

<style scoped>

</style>
