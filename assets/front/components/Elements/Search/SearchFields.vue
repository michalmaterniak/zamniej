<template>
  <div class="">
    <div v-if="isShowResults" :class="{'padB100' : !isFavorites, 'padB30' : isFavorites}"
         class="popular-stores bg hidden-xs hidden-sm ">
      <div class="container">
        <div class="row">
          <div v-for="(shop, index) in shops" :key="index" class="col-md-3 col-sm-3 col-xs-6">
            <tile-shop-search :shop="shop"/>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isFavorites" class="popular-stores bg hidden-xs hidden-sm padB30">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="h3">Polubione sklepy</h3>
          </div>
        </div>
        <div class="row ">
          <div v-for="(shop, index) in favoriteShops" :key="index" class="col-md-3 col-sm-3 col-xs-6">
            <tile-shop-search :shop="shop" :with-remove="true"/>
          </div>
        </div>
      </div>
    </div>
    <div class="row padB100"></div>
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
    isFavorites() {
      return this.isSearchContainer && this.favoriteShops.length > 0
    },
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
          this.$router.push({path: res.data.shops[0].slug})
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
