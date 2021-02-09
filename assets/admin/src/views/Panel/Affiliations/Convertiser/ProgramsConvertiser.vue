<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <router-view @setPrograms="setPrograms" @setOrdering="setOrdering"/>
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
                <router-link :to="{name: 'panel-pages-page', params: {id: program.subpage.idSubpage}}"
                             v-if="isSubpage(program)" v-text="program.subpage.name"></router-link>
                <button class="btn btn-info" v-else>Brak podstrony</button>
              </td>
              <td>
                <button class="btn" :class="{'btn-success' : program.enable, 'btn-danger' : !program.enable}" ><span v-text="program.enable ? 'Dostępny' : 'Niedostępny'"></span></button>
              </td>
              <td>
                <router-link class="btn btn-info"
                             :to="{name: 'panel-affiliations-convertiser-program', params: {id: program.idShop}}"><i
                  class="mdi mdi-arrow-right"></i></router-link>
                <button-active-subpage :active="program.subpage.active" :id-subpage="program.subpage.idSubpage"
                                       @setActive="toggleActivePrograms(index, !program.subpage.active)"
                                       v-if="isSubpage(program)"/>
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
import ButtonActiveSubpage from "../../../../components/Subpages/ButtonActiveSubpage";
import activeManage from "../../../../mixins/Resources/activeManage";

export default {
  name: "ProgramsConvertiser",
  components: {ButtonActiveSubpage},
  mixins: [activeManage],
  data() {
    return {
      programs: [],
      filtersTable: {
        nameFilter: '',
        enableFilter: 1,
        affiliationFilter: ''
      },
      orderingTable: {
        by: 'idShop',
        ordering: 'asc'
      }
    }
  },
  computed:{
    programsOrdering() {
      return this.programs.sort((a, b) => {
        if(this.orderingTable.ordering === 'desc') {
          return _.get(a, this.orderingTable.by) < _.get(b, this.orderingTable.by);
        } else {
          return _.get(a, this.orderingTable.by) >= _.get(b, this.orderingTable.by);
        }
      });
    },
    programsFiltered() {
      return _.filter(this.programsOrdering, item => {

        if (this.filtersTable.nameFilter.toUpperCase() !== '' && !item.name.toUpperCase().includes(this.filtersTable.nameFilter.toUpperCase())) {
          return false;
        }

        if (this.filtersTable.affiliationFilter.toUpperCase() !== '' && !item.affiliation.name.toUpperCase().includes(this.filtersTable.affiliationFilter.toUpperCase())) {
          return false;
        }

        if (this.filtersTable.enableFilter !== 2 && Boolean(this.filtersTable.enableFilter) !== item.enable) {
          return false;
        }

        return true;
      });
    }
  },
  methods: {
    isSubpage(program) {
      return Boolean(program.subpage) && Boolean(program.subpage.idSubpage);
    },
    setPrograms(programs) {
      this.programs = programs;
    },
    setOrdering(ordering) {
      this.orderingTable = ordering;
    }
  },

}
</script>

<style scoped>
.table > thead > tr > th{
  vertical-align: top;
}
</style>
