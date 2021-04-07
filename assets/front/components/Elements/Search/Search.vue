<template>
  <li class="search-input">
    <div class="header-searchbar">
      <input v-model="searchText" name="search" placeholder="Szukaj..." type="text" @click="clickSearch">
      <button class="search-btn hidden-xs hidden-sm" type="submit">
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
    $route (to, from){
      this.searchText = '';
    },
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
    clickSearch() {
      this.searchContainer();
      this.searchText = '';
    },
    searchContainer() {
      this.$store.commit('setSearchContainerOpen', true);
    },
    setKeywordText(searchText) {
      this.$store.commit('setSearchKeyword', searchText);
    }
  }
}
</script>

<style scoped>
.search-input {

}
</style>
