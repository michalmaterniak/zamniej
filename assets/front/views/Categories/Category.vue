<template>
<div v-if="$store.getters.typePage === 'Categories-Category'">
  <bread-crumbs/>

  <div class="deals bg padTB60">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 marB30" v-for="(shop, index) in shops" :key="index">
              <tile-shop :shop="shop"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- //***Deals-List End***// -->
  <div class="clear"></div>
</div>
</template>

<script>
import Categories from "@/components/Menu/Categories/Categories";
import Slider from "@/components/Sliders/Slider";
import BreadCrumbs from "@/components/BreadCrumbs/BreadCrumbs";
import TileShop from "@/components/Tiles/Shop/TileShop";
export default {
  name: "Category",
  components: {TileShop, BreadCrumbs, Slider, Categories},
  computed:{
    model()
    {
      return this.$store.getters.model;
    },
    shops() {
      return this.model.subpage.shopsListing;
    }
  },
  mounted() {
  }
}
</script>

<style scoped>
.cart-btn:hover
{
  background-color: #fff;
  color: #000;
  border: #f57f25 solid;
}

.box-pagiation
{
  position: fixed;
}

</style>
