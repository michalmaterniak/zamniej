<template>
  <div id="mySidenav" class="sidenav" :class="{'open-side' : $store.getters.leftSidebar}">
    <button class="sidebar-overlay" @click.prevent.stop="closeNav"></button>
    <nav>
      <div @click="closeNav">
        <div class="sidebar-back text-left">
          <i aria-hidden="true" class="fa fa-angle-left pr-2"></i> Back
        </div>
      </div>
      <ul id="sub-menu" class="sm pixelstrap sm-vertical">
        <li v-for="(category, index) in links.categories" :key="index">
          <nuxt-link @click.native="closeNav" :to="{path: category.link}"  v-text="category.name"></nuxt-link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "LeftSidebar",
  computed:{
    links() {
      return this.$store.getters.initFront.data.links.categories;
    },
  },
  methods:{
    closeNav()
    {
      this.$store.commit('setLeftSidebar', false);
    }
  }
}
</script>

<style scoped>

</style>
