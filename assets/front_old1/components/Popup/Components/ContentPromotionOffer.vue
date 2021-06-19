<template>
  <div>
    <div class="row">
      <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 text-left marT30 content-popup-promo">
        <h3 class="no-actual-popup" v-if="!offer.offer.actual">Nieaktualne</h3>
        <img :src="offer.photo.modifyPath" class="marL20 img-thumbnail-promotion-logo">
        <div class="content-promo" v-html="offer.offer.content.content"></div>
      </div>
    </div>
    <div class="row marT10" v-if="offer.offer.actual">
      <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 text-right">
        <code-clipboard v-if="offer.typeOffer === 'voucher'" :code="offer.offer.data.code"/>
        <div v-else class="bold">Promocja nie wymaga kodu rabatowego!</div>
      </div>
    </div>
  </div>
</template>

<script>
import CodeClipboard from "@/components/Popup/Components/CodeClipboard";
export default {
  name: "ContentPromotionOffer",
  components: {CodeClipboard},
  props:['offer']
}
</script>

<style scoped>
/*.content-popup-promo:before{*/
/*  content: 'nieaktualne'*/
/*}*/
</style>
