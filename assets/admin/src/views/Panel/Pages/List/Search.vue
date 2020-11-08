<template>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped" v-if="resources.length > 0">
        <thead>
        <tr>
          <th scope="col" style="wparentth: 10%">LP.</th>
          <th scope="col" style="wparentth: 60%">Nazwa</th>
          <th scope="col" style="wparentth: 30%">Działania</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(model, index) in resources" :key="index" v-if="model.modelEntity.config.hidden === false">
          <th scope="row" v-html="index+1"></th>
          <td>
            <router-link :to="{name: 'panel-pages-page', params: {id: model.modelEntity.idResource} }">
              <span v-text="model.modelEntity.name"></span>
            </router-link>

          </td>
          <td>
            <router-link tag="a" class="btn btn-info"
                         :to="{name: 'panel-pages-page', params: {id: model.modelEntity.idResource} }">
              <i class="mdi mdi-arrow-right-bold"></i>
            </router-link>

            <router-link tag="button" class="btn btn-info" :title="model.modelEntity.countChildren + ' podstron'" :disabled="model.modelEntity.countChildren === 0"
                         :to="{name: 'panel-pages-list-parent', params: {parent: model.modelEntity.idResource} }">
              <i class="mdi mdi-arrow-down-bold"></i>
            </router-link>
          </td>
        </tr>
        </tbody>
      </table>
      <div v-else class="alert alert-info">Nie ma żadnych podstron
        <button class="btn btn-outline-info" @click="$router.back()"><i class="mdi mdi-arrow-left-bold"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Search",
  props: {
    search: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      searchText: '',
      resources: []
    }
  },
  watch:{
    search(from, to) {
      this.loadResources();
      this.loadResources();
    }
  },
  methods: {
    loadResources() {
      this.ajax({
        url: '/admin/api/pages/resource-listing-search',
        data:{
          search: this.search
        },
        responseCallbackSuccess: res => {
          this.resources = res.data.resources;
        }
      });
    }
  },
  created() {
    this.$emit('setIdParent', null);
    this.searchText = this.search;
    this.loadResources();
  }
}
</script>

<style scoped>

</style>
