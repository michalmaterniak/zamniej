<template>
  <div class="modal-content">
    <div class="modal-header">

      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <input type="text" class="form-control" placeholder="Znajdź podstronę" v-model="searchText" @change="searchSubpage">
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table" v-if="subpages.length > 0">
            <thead>
              <tr>
                <th scope="col">Lp</th>
                <th scope="col">Id</th>
                <th scope="col">Nazwa</th>
              </tr>
            </thead>
            <tbody>
              <tr class="pointerCursor" v-for="(subpage, index) in subpages" @click="select(subpage.idSubpage)" :class="{'table-primary' : subpage.idSubpage === selectedSubpage}">
                <th scope="row" v-text="index+1"></th>
                <td v-text="subpage.idSubpage"></td>
                <td v-text="subpage.name"></td>
              </tr>
            </tbody>
          </table>
          <div v-else class="alert alert-info">
            Brak podstron
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success" @click="tie" v-if="selectedSubpage">Połącz z wybraną stroną</button>
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
      selectedSubpage: null,
      searchText: '',
      subpages: [],
    }
  },
  computed:{
  },
  methods:{
    searchSubpage()
    {
      this.ajax({
        url: '/admin/api/affiliations/program/searchSubpages',
        data:{
          name: this.searchText
        },
        responseCallbackSuccess: res => {
          this.subpages = res.data.subpages;
        }
      })
    },
    select(idSubpage)
    {
      if (this.selectedSubpage === idSubpage)
        this.selectedSubpage = null;
      else
        this.selectedSubpage = idSubpage
    },
    tie()
    {
      this.data.tie(this.selectedSubpage);
      this.closePopup();
    }
  },
  created() {
    this.searchText = this.data.name;
    this.searchSubpage();
  }
}
</script>

<style scoped>

</style>
