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
      <component :is="contentComponent" :form="contentTypeComponent" :key="contentTypeComponent + '-' + parent"/>
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
		name: "PageNew",
    components: {ChangeLocaleSelect},
    props:['parent', 'child'],
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
      parent() {
        this.loadForm();
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
          url: '/admin/api/pages/resource-new/' + this.parent + '/' + this.child,
          responseCallbackSuccess: res => {
            this.showAlert('Poprawnie utworzono nową stronę', 'success');
            this.$router.push({name: 'panel-pages-page', params: {id: res.data.resource.modelEntity.idResource}});
          },
          responseCallbackError: res => {
            this.showErrorsValidate("Błąd podczas zapisu", res.data.errors);
          }
        });
      },
      changeContentComponent(type)
      {
        this.contentTypeComponent = type;
      },
      loadForm()
      {
        this.ajax({
          url: '/admin/api/pages/resource-form-child/' + this.parent + '/' + this.child,
          responseCallbackSuccess: res => {
            this.$store.commit('setResource', {
              modelEntity: {
                subpages: {

                }
              }
            });
            this.$store.commit('setForms', res.data.form);
          },
          responseCallbackError: res => {
            this.showAlert('Błąd serwera!', 'danger');
          }
        })
      }
    },
    created() {
      this.loadForm();
    },
    destroyed() {
      this.$store.commit('setResource', null);
      this.$store.commit('setForms', null);
    }
  }
</script>

<style scoped>
</style>
