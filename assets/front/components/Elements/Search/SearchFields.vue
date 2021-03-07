<template>
  <div class=" padT50 padB50 ">
    <div v-if="isShowResults" class="popular-stores bg hidden-xs hidden-sm">
      <div class="container">
        <div class="row">
          <div v-for="(shop, index) in shops" :key="index" class="col-md-3 col-sm-3 col-xs-6 marB30">
            <tile-shop-search :shop="shop"/>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isSearchContainer && favoriteShops.length > 0" class="popular-stores bg hidden-xs hidden-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="h3">Polubione sklepy</h3>
          </div>
        </div>
        <div class="row marT30">
          <div v-for="(shop, index) in favoriteShops" :key="index" class="col-md-3 col-sm-3 col-xs-6 marB30">
            <tile-shop-search :shop="shop" :with-remove="true"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "SearchFields",
  data() {
    return {
      startLenghtSearch: 2,
      enable: false
    }
  },
  watch: {
    $route (to, from){
      this.$store.commit('setSearchContainerOpen', false);
    },
    shopName: function (val) {
      if (val.length >= this.startLenghtSearch) {
        this.searchShops();
      } else {
        this.enable = false;
      }
    },
    favoriteShops: function (val) {
      if(val.length === 0) {
        this.$store.commit('setSearchContainerOpen', false);
      }
    }
  },
  computed: {
    ...mapGetters([
      'favoriteShops',
    ]),
    isSearchContainer() {
      return this.$store.getters.isSearchContainer;
    },
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
          this.$store.commit('setSearchContainerOpen', false);
          this.$store.commit('setSearchKeyword', '');
          this.$router.push({path: res.data.shops[0].slug})
        } else {
          this.$store.commit('setSearchKeyword', '');
        }
      })
    },
  },
  created() {
    this.searchShops();
  },
  mounted() {
    this.favoriteShopsArray = Object.values(this.favoriteShops);
  }
}
</script>

<style scoped>

</style>
