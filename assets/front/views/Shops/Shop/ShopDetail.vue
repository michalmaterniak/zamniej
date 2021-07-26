<template>
  <div class="rtl-text col-lg-4  d-sm-block" :class="{'d-none' : !$store.getters.isShopDetailsOpen}">
    <div class="product-right pro_sticky_info" data-sticky_column>
      <div class="row align-items-center">
        <div class="col-8">
          <h2 class="h3" v-text="shop.subpage.subpage.name"></h2>
        </div>
        <div class="col-4">
          <img :alt="shop.subpage.seo.header"
               :src="shop.subpage.logo.modifyPath"
          >
        </div>
      </div>
      <div class="media">
        <label>Ocena {{ shop.subpage.subpage.name }} <strong>{{ shop.rating.rating }}</strong>/{{ shop.rating.count }}</label>
        <rating-shop />
      </div>
      <div class="product-description border-product">

      </div>
      <div class="product-buttons">
        <main-button @click.prevent.stop.native="redirectShop"/>
      </div>
      <div class="border-product" v-if="shop.subpage.subpage.content.extra.details">
        <p v-text="model.subpage.subpage.content.data.description"></p>

        <div class="mt-3">
          <h4><strong>Adres</strong></h4>
          <p v-text="shop.subpage.subpage.content.data.details.address.street"></p>
          <p v-text="shop.subpage.subpage.content.data.details.address.location"></p>
        </div>
        <contact-details :contact="shop.subpage.subpage.content.data.details.contact"/>
      </div>
    </div>
  </div>
</template>

<script>
import ContactDetails from "@/views/Shops/Shop/ContactDetails";
import MainButton from "@/views/Shops/Shop/MainButton";
import RatingShop from "@/views/Shops/Shop/RatingShop";

export default {
  name: 'ShopDetail',
  components: {RatingShop, MainButton, ContactDetails},
  computed:{
    model() {
      return this.$store.getters.model;
    },
    shop() {
      return this.model;
    }
  }
}
</script>

<style scoped>

</style>
