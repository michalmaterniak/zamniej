<template>
  <div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 v-text="convertLetter(letterText)"></h3>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" v-for="(shop, index) in shops" :key="index">
          <tile-shop :shop="shop" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import TileShop from "@/views/Shops/Shops/TileShop";
export default {
  name: 'ShopsListing',
  components: {TileShop},
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
