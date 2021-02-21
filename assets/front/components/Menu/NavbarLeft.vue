<template>
  <div >
    <header v-if="links">
      <!-- TOP HEADER -->

      <!-- /TOP HEADER -->

      <!-- MAIN HEADER -->
      <div id="header" :class="{'opacity-0-xs hidden-sm hidden-md hidden-lg' : hiddenHeader && !showResponsive}">
        <!-- container -->
        <div class="container">
          <!-- row -->
          <div class="row">
            <!-- LOGO -->
            <div class="header-ctn">
              <div @click.stop.prevent="toggleResponsiveMenu" class="menu-toggle" :class="{'fixed-toggle' : showResponsive}">
                <a href="#">
                  <font-awesome-icon icon="bars" />
                  <span>Menu</span>
                </a>
              </div>
            </div>
            <!-- responsive-nav -->
            <div id="responsive-nav" :class="{'active' : showResponsive}">
              <!-- NAV -->
              <ul class="main-nav nav navbar-nav">
                <nuxt-link tag="li" v-for="(link, index) in links" :key="index" :to="{path: link.link}" exact-active-class="active"><nuxt-link :to="{path: link.link}" exact-active-class="active" v-text="link.name"></nuxt-link></nuxt-link>
                <li class="search-input">
                  <div class="header-searchbar " @click="openSearchPopup">
                    <input type="text" name="search" placeholder="Szukaj...">
                    <button type="submit" class="search-btn">
                      <i class="flaticon-external-link-symbol"></i>
                    </button>
                  </div>
                </li>
              </ul>
              <!-- /NAV -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- NAVIGATION -->
    <nav id="navigation">
      <!-- container -->
      <div class="container">

      </div>
      <!-- /responsive-nav -->
      <!-- /container -->
    </nav>
  </div>
</template>

<script>
export default {
  name: "NavbarLeft",
  data(){
    return {
      responsive: null,

      touchWidth: 0,
      touchHeight: 0,

      hiddenHeader: false,

      scrollY: 0
    }
  },
  watch:{
    $route(to, from){
      this.$store.commit('setResponsiveMenu', false);
    },
    scrollY(prev, next)
    {
      this.hiddenHeader = (prev > next);
    }
  },
  computed:{
    showResponsive()
    {
      return this.$store.getters.isResponsiveMenu;
    },
    links()
    {
      return this.$store.getters.initFront.data.links.navbar;
    }
  },
  methods: {
    toggleResponsiveMenu(e) {
      this.$store.commit('setResponsiveMenuToggle');
    },
    openSearchPopup() {
      this.$store.commit('setPopup', {
        template: () => import("@/components/Popup/PopupSearch"),
        title: 'Szukaj sklepu'
      })
    }
  },
  mounted() {
    window.addEventListener('scroll', ev => {
      this.scrollY = window.scrollY;
    })
    document.addEventListener('swiped-right', e => {
      this.$store.commit('setResponsiveMenu', true);
    });
    document.addEventListener('swiped-left', e => {
      this.$store.commit('setResponsiveMenu', false);
    });
  }
}
</script>

<style scoped>
.row{
  max-width: 100%;
}
.search-input{
  margin-left: 100px;
}
</style>
