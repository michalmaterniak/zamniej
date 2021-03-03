<template>
  <div v-if="isShowResults" class="popular-stores bg padT50 padB100 hidden-xs hidden-sm">
    <div class="container">
      <div class="row">
        <div v-for="(shop, index) in shops" :key="index" class="col-md-3 col-sm-3 col-xs-6 marB30">
          <tile-shop-search :shop="shop"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchFields",
  data() {
    return {
      startLenghtSearch: 2,
      enable: false
    }
  },
  watch: {
    shopName: function (val) {
      if (val.length >= this.startLenghtSearch) {
        this.searchShops();
      } else {
        this.enable = false;
      }
    }
  },
  computed: {
    shops() {
      return this.$store.getters.searchShops;
    },
    shopName() {
      return this.$store.getters.searchKeyword;
    },
    isShowResults() {
      return this.enable && this.shopName.length >= this.startLenghtSearch;
    }
  },
  methods: {
    searchShops() {
      this.$axios({
        method: "POST",
        url: 'page/api/shops/search',
        responseType: 'json',
        data: {
          shop: this.shopName
        },
      }).then(res => {
        if (res.data.count > 0) {
          this.$store.commit('setSearchShops', res.data.shops);
          this.enable = true;
        } else if (res.data.count === 1) {
          this.$router.push({path: res.data.shops[0].slug})
          this.$store.commit('setSearchKeyword', '');
        } else {
          this.$store.commit('setSearchKeyword', '');
        }
      })
    },
  },
  created() {
    this.searchShops();
  }
}
</script>

<style scoped>

</style>
