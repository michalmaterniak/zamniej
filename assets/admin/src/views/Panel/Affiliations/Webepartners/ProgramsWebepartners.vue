<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <router-view @setPrograms="setPrograms"/>
        </div>
      </div>
    </div>
    <div class="row" v-if="programs.length > 0">
      <div class="col-md-12">
        <div class="card">
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col" style="width: 5%">Lp.</th>
              <th scope="col" style="width: 5%">Id</th>
              <th scope="col" style="width: 10%">Afiliacja<input type="text" class="form-control" v-model="filtersTable.affiliationFilter"></th>
              <th scope="col" style="width: 20%">Nazwa<input type="text" class="form-control" v-model="filtersTable.nameFilter"></th>
              <th scope="col" style="width: 10%">Strona</th>
              <th scope="col" style="width: 5%">Dostępność
                <button class="btn" :class="{'btn-info' : filtersTable.enableFilter === 2,'btn-success' : filtersTable.enableFilter === 1, 'btn-danger' : filtersTable.enableFilter === 0}" @click="filtersTable.enableFilter = (filtersTable.enableFilter + 1)%3">
                  <span v-if="filtersTable.enableFilter === 2">Dowolne</span>
                  <span v-else-if="filtersTable.enableFilter === 1">Dostępne</span>
                  <span v-else-if="filtersTable.enableFilter === 0">Niedostępne</span>
                </button>
              </th>
              <th scope="col" style="width: 20%">Działania</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(program, index) in programsFiltered" :key="index">
              <th scope="row" v-text="index+1"></th>
              <td v-text="program.idShop"></td>
              <td v-text="program.affiliation.name"></td>
              <td v-text="program.name"></td>
              <td>
                <router-link v-if="program.subpage && program.subpage.idSubpage" :to="{name: 'panel-pages-page', params: {id: program.subpage.idSubpage}}" v-text="program.subpage.name"></router-link>
                <button class="btn btn-info" v-else>Brak podstrony</button>
              </td>
              <td>
                <button class="btn" :class="{'btn-success' : program.enable, 'btn-danger' : !program.enable}" ><span v-text="program.enable ? 'Dostępny' : 'Niedostępny'"></span></button>
              </td>
              <td>
                <router-link class="btn btn-info" :to="{name: 'panel-affiliations-webepartners-program', params: {id: program.idShop}}"><i class="mdi mdi-arrow-right"></i></router-link>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Programs",
  data(){
    return {
      programs: [],
      filtersTable:{
        nameFilter: '',
        enableFilter: 1,
        affiliationFilter: ''
      }
    }
  },
  watch:{
    $route() {

      this.$nextTick(() => {
      });
    }
  },
  computed:{
    programsReverse() {
      return this.programs.reverse();
    },
    programsFiltered() {
      return _.filter(this.programsReverse, item => {

        if (this.filtersTable.nameFilter.toUpperCase() !== '' && !item.name.toUpperCase().includes(this.filtersTable.nameFilter.toUpperCase()))
          return false;
        if (this.filtersTable.affiliationFilter.toUpperCase() !== '' && !item.affiliation.name.toUpperCase().includes(this.filtersTable.affiliationFilter.toUpperCase()))
          return false;
        if (this.filtersTable.enableFilter !== 2 && this.filtersTable.enableFilter != item.enable)
          return false;
        return true;
      });
    }
  },
  methods:{
    setPrograms(programs)
    {
      this.programs = programs;
    }
  },

}
</script>

<style scoped>
.table > thead > tr > th{
  vertical-align: top;
}
</style>
