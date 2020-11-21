<template>
<div  v-if="$store.getters.resource">
  <div class="row">
    <div class="col-md-8">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"> <a class="nav-link " href="#" :class="{active : contentTypeComponent === 'basic'}" data-toggle="tab" role="tab" @click="changeContentComponent('basic')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Podstawowe</span></a> </li>
        <li class="nav-item"> <a class="nav-link" href="#" :class="{active : contentTypeComponent === 'subpage'}" data-toggle="tab" role="tab" @click="changeContentComponent('subpage')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Zawartość strony</span></a> </li>
        <li class="nav-item"> <a class="nav-link" href="#" :class="{active : contentTypeComponent === 'seo'}" data-toggle="tab" role="tab" @click="changeContentComponent('seo')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">SEO</span></a> </li>
      </ul>
    </div>
    <div class="col-md-2">
      <div class="btn btn-success" @click="save">Zapisz</div>
    </div>
    <div class="col-md-2">
      <change-locale-select/>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-12">
      <component :is="contentComponent" :form="contentTypeComponent" :key="contentTypeComponent + '-' + id"/>
    </div>
  </div>
</div>
</template>

<script>

  import ChangeLocaleSelect from "../../../components/System/ChangeLocaleSelect";
  import BasicContentComponent from "../../../components/Page/Basic/BasicContentComponent";
  import SubpageContentComponent from "../../../components/Page/Subpage/SubpageContentComponent";
  import SeoContentComponent from "../../../components/Page/Seo/SeoContentComponent";

  export default {
		name: "Page",
    components: {ChangeLocaleSelect},
    props:['id'],
    data(){
      return{
        contentTypeComponent: 'basic',
        typesContentComponent: {
          basic: BasicContentComponent,
          subpage: SubpageContentComponent,
          seo: SeoContentComponent,
        }
      }
    },
    watch:{
		  id() {
        this.loadResource();
      }
    },
    computed:{
      contentComponent()
      {
        return this.typesContentComponent[this.contentTypeComponent];
      }
    },
    methods:{
		  save(){
        this.ajax({
          data: this.$store.getters.changes,
          url: '/admin/api/pages/resource-store/' + this.id,
          responseCallbackSuccess: res => {
            this.$store.commit('setResource', res.data.resource);
            this.$store.commit('setChanges', {});
            this.showAlert('Poprawnie zapisano', 'success');
          },
          responseCallbackError: res => {
            if(res.status === 400)
              this.showErrorsValidate("Błąd podczas zapisu", res.data.errors);
            else
              this.showAlert('Błąd serwera', 'danger');
          }
        });
      },
      changeContentComponent(type)
      {
        this.contentTypeComponent = type;
      },
		  loadResource()
      {
        this.ajax({
          url: '/admin/api/pages/resource-item/' + this.id,
          responseCallbackSuccess: res => {
            this.$store.commit('setResource', res.data.resource);
            this.$store.commit('setForms', res.data.form);
          }
        });
      }
    },
    created() {
      this.loadResource();
    },
    destroyed() {
      this.$store.commit('setResource', null);
      this.$store.commit('setForms', null);
      this.$store.commit('setChanges', {});
    }
  }
</script>

<style scoped>
</style>
