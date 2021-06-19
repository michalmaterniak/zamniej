<template>
  <div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="search marT40">
          <h3 class="orange" v-text="convertLetter(letterText)"></h3>
        </div>
        <div class="coupon-detail" v-for="(shop, index) in shops" :key="index">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <tile-shop :shop="shop" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TileShopAll from "@/components/Tiles/Shop/TileShopAll";
import TileShop from "@/components/Tiles/Shop/TileShop";
export default {
  name: "ShopsListing",
  components: {TileShop, TileShopAll},
  props:{
    shops: {
      type: Array,
      default: () => []
    },
    letter: {
      type: String,
      default: null
    }
  },
  computed:{
    letterText()
    {
      if(this.letter === null)
        return this.$router.currentRoute.query.letter;
      else if(this.letter == 0)
        return '0-9';
      else
        return this.letter;
    },
  },
  methods:{

    convertLetter(letter)
    {
      if(letter == 0 )
        return '0-9';
      else
        return letter;
    }
  }
}
</script>

<style scoped>

</style>
