<template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <input type="text" class="form-control" placeholder="Znajdź podstronę" v-model="searchText" @change="searchCategories">
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table" v-if="categories.length > 0">
            <thead>
            <tr>
              <th scope="col">Lp</th>
              <th scope="col">Id</th>
              <th scope="col">Nazwa</th>
            </tr>
            </thead>
            <tbody>
            <tr class="pointerCursor" v-for="(category, index) in categories" @click="select(category.idSubpage)" :class="{'table-primary' : category.idSubpage === selectedCategory}">
              <th scope="row" v-text="index+1"></th>
              <td v-text="category.idSubpage"></td>
              <td v-text="category.name"></td>
            </tr>
            </tbody>
          </table>
          <div v-else class="alert alert-info">
            Brak kategorii
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success" @click="create" v-if="selectedCategory">Twórz</button>
      <button type="button" class="btn btn-dark" @click="closePopup">Zamknij</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "PopUpSearchSubpages",
  props: ['title', 'data'],
  data(){
    return {
      categories: [],
      searchText: '',
      selectedCategory: null
    }
  },

  methods:{
    select(idSubpage)
    {
      if (this.selectedCategory === idSubpage)
        this.selectedCategory = null;
      else
        this.selectedCategory = idSubpage
    },
    create()
    {
      if (this.selectedCategory)
      {
        this.data.create(this.selectedCategory);
        this.closePopup();
      }
    },
    searchCategories()
    {
      if (!this.searchText)
        return ;

      this.ajax({
        url: '/admin/api/pages/categories-listing',
        data:{
          category: this.searchText,
        },
        responseCallbackSuccess: res => {
          this.categories = res.data.categories;
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
