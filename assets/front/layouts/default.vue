<template>
  <div>
    <loader/>
    <navbar/>
    <bread-crumb/>
    <nuxt/>
    <main-footer/>
    <tap-top/>
    <pop-up-view/>
    <debugbar v-if="debugActive"/>
  </div>
</template>

<script>
import Vue from 'vue';
import pages from "@/mixins/pages";
import Debugbar from "@/components/Development/Debugbar/Debugbar";
import Navbar from "@/layouts/default/Navbar";
import Loader from "@/components/Loader/Loader";
import TapTop from "@/components/Tap/TapTop";
import MainFooter from "@/layouts/default/MainFooter";
import BreadCrumb from "@/layouts/default/BreadCrumb";
import PopUpView from "@/components/Popup/PopUpView";

Vue.mixin(pages);

export default {
  mixins:[pages],
  components: {PopUpView, BreadCrumb, MainFooter, TapTop, Loader, Navbar, Debugbar},
  watch:{
    $route(to, from)
    {
      this.$nextTick().then(() => {
        this.$lazyHide();
      });
    }
  },
  computed:{
    debugActive(){
      return this.$store.getters.debug.active && process.env.NODE_ENV === 'development';
    }
  },
  methods:{
    setFavoritesShops() {
      let localStorageFavoriteShops = localStorage.getItem('favoriteShops');
      if(localStorageFavoriteShops) {
        localStorageFavoriteShops = JSON.parse(localStorageFavoriteShops);
      } else {
        localStorageFavoriteShops = [];
      }

      this.$store.commit('setFavoriteShop', localStorageFavoriteShops);
    }
  },
  mounted() {
    this.setFavoritesShops();
  },
}
</script>

<style scoped>
</style>
