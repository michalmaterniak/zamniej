<template>
  <div>
    <!-- tap to top -->
    <div class="tap-top top-cls">
      <div>
        <i class="fa fa-angle-double-up"></i>
      </div>
    </div>
    <!-- tap to top end -->
    <!-- other -->
    <div class="tap-shop" v-if="$store.getters.typePage === 'Shops-Shop'">
      <div>
        <main-button class="tap-shop-button"/>
      </div>
    </div>
    <!-- other -->
  </div>

</template>

<script>
import MainButton from "@/views/Shops/Shop/MainButton";
export default {
  name: 'TapTop',
  components: {MainButton},
  data() {
    return {
      tapTop: false,
      tapShop: false
    }
  },
  mounted() {
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
        if (window.innerWidth >= 576 && window.innerWidth < 992) {
          $('.tap-shop').fadeIn();
        } else {
          $('.tap-shop').fadeOut();
        }
      } else {
        $('.tap-top').fadeOut();
        $('.tap-shop').fadeOut();
      }
    });

    $('.tap-top').on('click', function () {
      $("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  }
}
</script>

<style scoped>
.tap-shop {
  position: fixed;
  bottom: 70px;
  right: 30%;
  display: none;
}

@media (max-width: 575px) and (min-width: 992px) {
  .tap-shop {
    display: none !important;
  }
}

.tap-shop-button {
  border-radius: 25px;
  width: 300px;
}
</style>
