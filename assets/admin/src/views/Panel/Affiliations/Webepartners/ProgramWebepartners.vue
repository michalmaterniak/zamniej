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
        <router-link :to="{name: 'panel-pages-page', params: {id: program.subpage.idSubpage}}" class="btn btn-primary">Podstrona</router-link>
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
import ProgramWebepartners from "./ProgramWebepartners";
import PopUpCreateSubpage from "../../../../components/PopUp/Programs/PopUpCreateSubpage";
import PopUpSearchSubpages from "../../../../components/PopUp/Programs/PopUpSearchSubpages";
import DetailsWebepartnersProgram from "./Program/DetailsWebepartnersProgram";

export default {
  components: {DetailsWebepartnersProgram},
  props:['id'],
  name: "ProgramWebepartners",
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
    trash()
    {
      this.ajax({
        url: '/admin/api/affiliations/program/trash/' + this.program.idShop,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
        }
      })
    },
    createSubpagePopUp(){
      this.openPopup('Twórz stronę sklepu', {
        template: PopUpCreateSubpage,
        classDialog: 'maxWidth75',
        data: {
          name: this.program.name,
          create: idCategory => {
            this.createSubpage(idCategory);
          }
        }
      })
    },
    createSubpage(idCategory)
    {
      this.ajax({
        url: '/admin/api/affiliations/program/createShopSubpage/' + idCategory + '/' + this.program.idShop,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
          this.showAlert('Utworzono podstronę programu afiliacyjnego!', 'success');
        }
      })
    },
    searchSubpage(){
      this.openPopup('Wyszukiwanie stron', {
        template: PopUpSearchSubpages,
        classDialog: 'maxWidth75',
        data: {
          name: this.program.name,
          tie: id => {
            this.tieProgramWithSubpage(id);
          }
        }
      })
    },
    tieProgramWithSubpage(idSubpage)
    {
      this.ajax({
        url: '/admin/api/affiliations/program/tie/' + this.program.idShop,
        data:{
          idSubpage: idSubpage,
        },
        responseCallbackSuccess: res => {
          this.showAlert('Powiązano program ze stroną', 'success');
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
