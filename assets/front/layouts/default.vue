<template>
  <div>
    <loader/>
    <navbar-left/>
    <search-fields v-if="$store.getters.searchKeyword"/>
    <nuxt/>
    <footer-module/>
    <pop-up-view/>
    <debugbar v-if="debugActive"/>
  </div>
</template>

<script>
import Vue from 'vue';
import Loader from "@/components/Loader/Loader";
import FooterModule from "@/components/Footer/Footer";
import Navbar from "@/components/Menu/Navbar";
import NavbarLeft from "@/components/Menu/NavbarLeft";
import PopUpView from "@/components/Popup/PopUpView";
import pages from "@/mixins/pages";
import Debugbar from "@/components/Development/Debugbar/Debugbar";

Vue.mixin(pages);

export default {
  mixins:[pages],
  components: {Debugbar, PopUpView, NavbarLeft, Navbar, FooterModule, Loader},
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
  mounted() {
  },
}
</script>

<style scoped>
</style>
