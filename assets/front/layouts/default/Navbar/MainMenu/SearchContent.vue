<template>
  <div>
    <span class="closebtn" @click="closeSearch" title="Close Overlay">×</span>
    <div class="overlay-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="form-group">
              <input v-model="searchValue"
                     ref="searchInput"
                     class="form-control"
                     placeholder="Szukaj sklepu"
                     type="text">
            </div>
            <button class="btn btn-primary" type="submit"><i
              class="fa fa-search"></i></button>
          </div>
        </div>
        <shops-searched :shops="shops"/>
        <shops-favorite/>
      </div>
    </div>
  </div>
</template>

<script>

import ShopsSearched from "@/layouts/default/Navbar/MainMenu/SearchContent/ShopsSearched";
import ShopsFavorite from "@/layouts/default/Navbar/MainMenu/SearchContent/ShopsFavorite";
export default {
  name: 'SearchContent',
  components: {ShopsFavorite, ShopsSearched},
  data() {
    return {
      shopName: '',
      searchValue: '',
      shops: []
    }
  },
  watch: {
    $route() {
      this.closeSearch();
    },
    searchValue(newValue) {
      if (newValue.length >= 3 && newValue.match(/^[0-9a-zA-Z]+$/i)) {
        this.shopName = newValue;
        this.searchShops();
      } else {
        this.shopName = '';
      }
    },
    isSearchOpen(newValue) {
      if (newValue) {
        this.$refs.searchInput.focus()
      }
    }
  },
  computed: {
    isSearchOpen() {
      return this.$store.getters.isSearchOpen;
    }
  },
  methods:{
    closeSearch() {
      this.searchValue = '';
      this.$store.commit('setSearchOpen', false);
      this.shops = [];
    },
    searchShops() {
      this.shops = [];
      this.$axios({
        method: "POST",
        url: 'page/api/shops/search',
        responseType: 'json',
        data: {
          shop: this.shopName
        },
      }).then(res => {
        if (res.data.count === 1) {
          this.shops = res.data.shops;
          // this.closeSearch();
          // this.$router.push({path: res.data.shops[0].slug});
        } else if (res.data.count > 1) {
          this.shops = res.data.shops;
          // this.$store.commit('setSearchShops', res.data.shops);
        }
      })
    },
  },
  mounted() {

    window.addEventListener('keyup', e => {
      if ((e.code === 'Escape' || e.key === 'Esc' || e.keyCode === 27) && this.$store.getters.isSearchOpen) {
        this.closeSearch();
      }
    })
  }
}
</script>

<style scoped>

</style>
