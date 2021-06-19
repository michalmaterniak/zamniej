<template>
  <!-- header start -->
  <header>
    <div class="mobile-fix-option"></div>
<!--    <top-header/>-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <main-menu :is-loader="false"/>
        </div>
      </div>
    </div>
  </header>
  <!-- header end -->
</template>

<script>
import LeftSidebar from "@/layouts/default/LeftSidebar";
import TopHeader from "@/layouts/default/Navbar/TopHeader";
import MainMenu from "@/layouts/default/Navbar/MainMenu";

export default {
  name: 'Navbar',
  components: {MainMenu, TopHeader, LeftSidebar},
  data() {
    return {
    }
  },
  computed:{
  },
  methods:{
    showSubmenu() {

    },
  },
  mounted() {

  }
}
</script>

<style scoped>

</style>
