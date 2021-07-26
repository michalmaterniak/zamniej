<template>
  <div class="main-menu">
    <div class="menu-left">
      <div class="navbar" v-if="isAvailableShowLeftMenu">
        <button class="btn btn-link" @click.prev.stop="openNav()">
          <i aria-hidden="true" class="fa fa-bars sidebar-bar"></i>
        </button>
        <left-sidebar v-if="isAvailableShowLeftMenu"/>
      </div>
    </div>
    <div class="menu-right pull-right">
      <div>
        <nav id="main-nav">
          <div class="toggle-nav" @click="openMobileMenu"><i class="fa fa-bars sidebar-bar"></i></div>
          <ul id="main-menu" class="sm pixelstrap sm-horizontal">
            <li>
              <div class="mobile-back text-right" @click="closeMobileMenu">
                Back <i aria-hidden="true" class="fa fa-angle-right pl-2"></i>
              </div>
            </li>
            <nuxt-link tag="li" v-for="(link, index) in links" :key="index" :to="{path: link.link}">
              <nuxt-link :to="{path: link.link}" v-text="link.name"></nuxt-link>
            </nuxt-link>
          </ul>
        </nav>
      </div>
      <div>
        <div class="icon-nav">
          <ul>
            <li class="onhover-div mobile-search">
              <div>
<!--                <img alt="" class="img-fluid blur-up lazyload" @click="openSearch" src="/page2/images/icon/search.png">-->
                <i class="ti-search" @click="openSearch()"></i>
              </div>
              <div v-if="!isLoader" id="search-overlay" class="search-overlay" :class="{'d-none' : !$store.getters.isSearchOpen}">
                <search-content/>
              </div>
            </li>
            <li v-if="$store.getters.typePage === 'Shops-Shop'"
                class="onhover-div mobile-setting red d-xl-none d-lg-none d-md-none d-sm-none">
              <div>
                <i class="fa fa-arrow-right" @click="redirectShop()"></i>
              </div>
            </li>
            <li v-if="$store.getters.typePage === 'Shops-Shop'"
                class="onhover-div mobile-cart red d-xl-none d-lg-none d-md-none d-sm-none">
              <div>
                <i class="fa fa-info" @click="openDetails()"></i>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LeftSidebar from "@/layouts/default/LeftSidebar";
import SearchContent from "@/layouts/default/Navbar/MainMenu/SearchContent";

export default {
  name: 'MainMenu',
  props: ['isLoader'],
  components: {SearchContent, LeftSidebar},
  data() {
    return {
      isOpenMobileMainMenu: false
    }
  },
  watch:{
    $route() {
      if (this.isOpenMobileMainMenu) {
        this.closeMobileMenu();
      }
    }
  },
  computed: {
    isAvailableShowLeftMenu() {
      if (!this.$store.getters.typePage) {
        return false;
      }

      return this.$store.getters.typePage === 'Homepages-Homepage';
    },
    links()
    {
      return this.$store.getters.initFront.data.links.navbar;
    }
  },
  methods:{
    openDetails() {
      this.$store.commit('setShopDetailOpen', true);
      this.$store.commit('setPopup', {
        template: () => import("@/components/Popup/PopupShopDetails"),
        title: 'Szczegóły sklepu',
        options: {
          blockedExit: true,
          actionAfterClose: (obj = {}) => {
            this.$store.commit('setShopDetailOpen', false);
          },
        }
      })
    },
    redirectShop() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop-mobile',
        label: 'shop-' + String(this.$store.getters.model.subpage.idShopAffil),
      });
      this.redirectInside(this.$store.getters.redirectLinkShop(this.$store.getters.model.subpage.idShopAffil));
    },
    openMobileMenu() {
      if (!this.isOpenMobileMainMenu) {
        $('.sm-horizontal').css("right", "0px");
        this.isOpenMobileMainMenu = true;
      }
    },
    closeMobileMenu() {
      if (this.isOpenMobileMainMenu) {
        $('.sm-horizontal').css("right", "-410px");
        this.isOpenMobileMainMenu = false;
      }
    },
    openNav() {
      this.$store.commit('setLeftSidebar', !this.$store.getters.leftSidebar);
    },
    openSearch() {
      this.$store.commit('setSearchOpen', true);
    },
  },
  mounted() {
    $('#main-menu').smartmenus({
      subMenusSubOffsetX: 1,
      subMenusSubOffsetY: -8
    });

    if ($(window).width() > '1200') {
      $('#hover-cls').hover(
        function () {
          $('.sm').addClass('hover-unset');
        }
      )
    }
  }
}
</script>

<style scoped>
.main-menu .menu-right .icon-nav .mobile-setting i {
  display: inline-block;
  font-size: 22px;
  color: var(--theme-deafult);
}
</style>
