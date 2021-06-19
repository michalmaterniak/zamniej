<template>
  <div class="box-a">
    <div class="box-detail box-details box-detail-white-back">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <h4 class="hover marB20"><a href="wishlist.html"><span v-text="i"></span>Flate 25% OFF on Men’s Clothing</a></h4>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 marT20 marB10 text-left">
        <div class="row">
          <button class="itg-btn cart-btn hover-black-button-promo" > Przejdz do promocji </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SliderPromotion",
  props:['i']
}
</script>

<style scoped>


</style>
