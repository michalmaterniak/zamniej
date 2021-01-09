<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-8">
                <input  type="text" class="form-control" placeholder="Wyszukaj podstronę..." v-model="searchText" @keyup.enter="search">
              </div>
              <div class="col-md-2">
                <button class="btn btn-info" @click="search">Wyszukaj</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
          </div>
        </div>
      </div>
    </div>
    <router-view/>
  </div>
</template>

<script>

import ButtonList from "../../../components/Buttons/ButtonList";
import CreatePage from "./List/CreatePage";

export default {
  name: "List",
  components: {CreatePage, ButtonList},
  data() {
    return {
      resources: [],
      searchText: '',
      idParent: null
    }
  },
  watch: {
    searchTextGlobal() {
      this.searchText = this.searchTextGlobal;
    },

    $route(to, from) {
      this.idParent = to.params.parent ? to.params.parent : null;
      this.searchText = to.params.search ? to.params.search : null;
    }
  },
  computed:{
    searchTextGlobal() {
      return this.$store.getters.searchTextListingPages;
    }
  },
  methods: {
    search(ev) {
      if(this.searchText.length >= 2 && this.searchText !== this.$router.currentRoute.params.search) {
        this.$router.push({name: 'panel-pages-list-search', params: {search: this.searchText}})
      }
    },
    setIdParent(id) {
      this.idParent = id;
    }
  }
}
</script>

<style scoped>

</style>
