<template>
  <li class="search-input">
    <div class="header-searchbar">
      <input v-model="searchText" name="search" placeholder="Szukaj..." type="text">
      <button class="search-btn hidden-xs hidden-sm" type="submit" @click="openSearchPopup">
        <i class="flaticon-external-link-symbol"></i>
      </button>
    </div>
  </li>
</template>

<script>
export default {
  name: "Search",
  data() {
    return {
      searchText: ''
    }
  },
  watch: {
    searchText() {
      this.setKeywordText(this.searchText);
    }
  },
  computed: {
    getSearchKeyword() {
      return this.$store.getters.searchKeyword;
    }
  },
  methods: {
    setKeywordText(searchText) {
      this.$store.commit('setSearchKeyword', searchText);
    },
    openSearchPopup() {
      this.$store.commit('setPopup', {
        template: () => import("@/components/Popup/PopupSearch"),
        title: 'Szukaj sklepu'
      })
    }
  }
}
</script>

<style scoped>
.search-input {

}
</style>
