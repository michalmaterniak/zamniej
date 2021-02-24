<template>
<div v-if="program">
  <div class="row" >
    <div class="col-md-4 text-left">
      <strong v-text="program.name"></strong>
    </div>
    <div class="col-md-8 text-right">
      <span v-if="program.subpage === null">
        <button class="btn btn-success" @click="createSubpagePopUp">Twórz stronę</button>
        <button class="btn btn-success" @click="searchSubpage">Wyszukaj</button>
      </span>
      <span v-else>
        <button class="btn btn-success" @click="update">Aktualizuj</button>
        <router-link :to="{name: 'panel-pages-page', params: {id: program.subpage.resource.idResource}}"
                     class="btn btn-primary">Podstrona</router-link>
      </span>
      <span>
        <button class="btn btn-danger" @click="trash">Do kosza</button>
      </span>
    </div>
  </div>
  <details-webepartners-program :program="program" />
</div>
</template>

<script>
import DetailsWebepartnersProgram from "./Program/DetailsWebepartnersProgram";
import affiliations from "../../../../mixins/Affiliations/affiliations";

export default {
  components: {DetailsWebepartnersProgram},
  props:['id'],
  name: "ProgramWebepartners",
  mixins:[affiliations],
  data(){
    return {
      program: null
    }
  },
  methods:{
    update() {
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-update/' + this.program.idShop,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
        }
      })
    },
    getProgram(){
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-program/' + this.id,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
        }
      })
    }
  },
  created() {
    this.getProgram();
  }
}
</script>

<style scoped>

</style>
