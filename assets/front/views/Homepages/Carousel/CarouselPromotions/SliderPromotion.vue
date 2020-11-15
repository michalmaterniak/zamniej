<template>
  <div class="box-a">
    <div class="box-detail box-details box-detail-white-back">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <h4 class="hover marB20" v-text="offer.title"></h4>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 marT20 marB10 text-left">
        <div class="row">
          <button @click="redirect" class="itg-btn cart-btn hover-black-button-promo"> Kod promocyjny</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SliderPromotion",
  props: ['i', 'offer'],
  methods: {
    redirect() {
      this.openPopupPromo(this.offer.idOffer, true, {
        action: 'redirect',
        category: 'offer',
        label: 'vouchers'
      })
    }
  },
}
</script>

<style scoped>


</style>
