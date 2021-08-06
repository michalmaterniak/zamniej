<template>
  <!-- tap to top -->
  <div class="tap-top top-cls">
    <div>
      <i class="fa fa-angle-double-up"></i>
    </div>
  </div>
  <!-- tap to top end -->
</template>

<script>
export default {
  name: 'TapTop',
  mounted() {
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
      } else {
        $('.tap-top').fadeOut();
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

</style>
